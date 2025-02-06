<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Event;
use App\Models\Ruangan;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class BookingController extends Controller
{
    function dataBooking()
    {
        $user = Auth::user();

        if ($user->hasRole('Perlengkapan')) {
            $data = Booking::with('event')->whereHas('event', function ($query) {
                $query->where('name', 'like', '%Tahfiz Quran%')
                    ->orWhere('name', 'like', '%Seminar%')
                    ->orWhere('name', 'like', '%Perpisahan Sekolah%');
            })->latest()->get();
        } elseif ($user->hasRole('Administrator')) {
            $data = Booking::with(['user', 'event', 'ruangan'])->latest()->get();
        }

        return view('pages.booking.admin.index', compact('data'));
    }

    function bokingCostumerIndex(): \Illuminate\View\View
    {
        $ruangan = Ruangan::all();
        $event = Event::all();
        return view('boking', compact('ruangan', 'event'));
    }

    public function simpanBokingCostumer(Request $request)
    {
        $eventName = Event::find($request->event_id)->name ?? '';

        $rules = [
            'user_id' => 'required|exists:users,id',
            'event_id' => 'required|exists:event,id',
            'ruangan_id' => 'required|exists:ruangans,id',
            'tanggal_booking' => 'required',
            'jadwal_start_time' => 'required|date_format:H:i',
            'jadwal_end_time' => 'required|date_format:H:i',
        ];

        if (in_array($eventName, ['Seminar', 'Perpisahan Sekolah', 'Tahfiz Quran'])) {
            $rules['upload_file'] = 'required|file|mimes:docx,pdf|max:2048';
        }

        $messages = [
            'required' => ':attribute wajib diisi.',
            'file' => ':attribute harus berupa file yang valid.',
            'mimes' => ':attribute harus berupa file dengan format: :values.',
            'max' => ':attribute tidak boleh lebih besar dari :max kilobyte.',
            'exists' => ':attribute tidak valid.',
        ];

        $attributes = [
            'user_id' => 'pengguna',
            'event_id' => 'event',
            'ruangan_id' => 'ruangan',
            'tanggal_booking' => 'tanggal booking',
            'upload_file' => 'file kop surat',
            'jadwal_start_time' => 'jam mulai',
            'jadwal_end_time' => 'jam selesai',
        ];

        $request->validate($rules, $messages, $attributes);

        $isBooked = Booking::where('tanggal_booking', $request->tanggal_booking)
            ->where('ruangan_id', $request->ruangan_id)
            ->where('status', '!=', 'tolak')
            ->where(function ($query) use ($request) {
                $query->whereBetween('jadwal_start_time', [$request->jadwal_start_time, $request->jadwal_end_time])
                    ->orWhereBetween('jadwal_end_time', [$request->jadwal_start_time, $request->jadwal_end_time])
                    ->orWhere(function ($query) use ($request) {
                        $query->where('jadwal_start_time', '<=', $request->jadwal_start_time)
                            ->where('jadwal_end_time', '>=', $request->jadwal_end_time);
                    });
            })
            ->exists();

        if ($isBooked) {
            return redirect()->route('costumer.formBoking')->withErrors(
                ['tanggal_booking' => 'Tanggal sudah diboking di jam yang sama']
            );
        }

        $fileName = null;
        if ($request->hasFile('upload_file')) {
            $file = $request->file('upload_file');
            $fileName = date('dmY') . time() . '_' . $file->getClientOriginalName();
            $fileName = $file->storeAs('upload/kopSurat', $fileName, 'public');
        }

        Booking::create([
            'user_id' => $request->user_id,
            'event_id' => $request->event_id,
            'ruangan_id' => $request->ruangan_id,
            'uploadKopSurat' => $fileName,
            'tanggal_booking' => $request->tanggal_booking,
            'jadwal_start_time' => $request->jadwal_start_time,
            'jadwal_end_time' => $request->jadwal_end_time,
            'status' => 'menunggu',
        ]);

        return redirect()->route('pengajuan.booking')->with('success', 'Booking berhasil disimpan.');
    }

    public function updateStatus(Request $request, $id)
    {
        $rules = [
            'status' => 'required|in:setujui,tolak,menunggu',
        ];

        if ($request->input('status') == 'tolak') {
            $rules['keterangan'] = 'required|string|max:255';
        }

        $request->validate($rules);

        $booking = Booking::with(['event'])->findOrFail($id);

        if (in_array($booking->event->name, ['Tahfiz Quran', 'Seminar', 'Perpisahan Sekolah'])) {
            if ($booking->uploadKopSurat) {
                $booking->status = $request->input('status');
                $booking->updated_at = now();
                if ($request->input('status') == 'setujui') {
                    $booking->keterangan = 'Disetujui';
                } elseif ($request->input('status') == 'menunggu') {
                    $booking->keterangan = 'Menunggu Konfirmasi';
                } elseif ($request->input('status') == 'tolak') {
                    $booking->keterangan = $request->input('keterangan');
                }
                $booking->save();

                return redirect()->route('admin.dataBooking')->with('success', 'Status berhasil diperbarui.');
            } else {
                return redirect()->back()->with('error', 'Kop surat wajib diunggah untuk jenis acara ini!');
            }
        } else {
            $booking->status = $request->input('status');
            $booking->updated_at = now();
            if ($request->input('status') == 'setujui') {
                $booking->keterangan = 'Disetujui';
            } elseif ($request->input('status') == 'tolak') {
                $booking->keterangan = $request->input('keterangan');
            }
            $booking->save();

            return redirect()->route('admin.dataBooking')->with('success', 'Status berhasil diperbarui.');
        }
    }

    private function createTransaksi($booking, $dp)
    {
        $sisaPelunasan = $booking->event->harga - $dp;

        Transaksi::create([
            'booking_id' => $booking->id,
            'user_id' => $booking->user_id,
            'event_id' => $booking->event_id,
            'ruangan_id' => $booking->ruangan_id,
            'dp' => $dp,
            'sisaPelunasan' => $sisaPelunasan,
            'status' => $sisaPelunasan <= 0 ? 'Lunas' : 'Belum Lunas',
        ]);
    }

    private function redirectAfterUpdate($userRole)
    {
        if ($userRole === 'Administrator') {
            return redirect('transaksi')->with('success', 'Transaksi berhasil disimpan.');
        }

        return redirect('/dataBooking')->with('success', 'Status berhasil diperbarui.');
    }

    function uploadBukti(Request $request, $id)
    {
        $request->validate([
            'buktiTransaksi' => 'required|file|mimes:png,jpeg,jpg,jfif|max:2048',
        ]);

        $booking = Booking::findOrFail($id);

        $file = $request->file('buktiTransaksi');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $path = $file->storeAs('uploads/berkas', $fileName, 'public');

        $booking->update(['buktiTransaksi' => $path]);

        return redirect()->back()->with('success', 'Bukti transaksi berhasil diunggah.');
    }

    public function indexBookingCostumer()
    {
        $booking = Booking::with(['event', 'ruangan'])
            ->where('user_id', auth()->id())
            ->get();

        foreach ($booking as $item) {
            if ($item->status == 'setujui' && now()->diffInHours($item->updated_at) > 24 && !$item->buktiTransaksi) {
                $item->update([
                    'status' => 'tolak',
                    'keterangan' => 'Waktu anda habis'
                ]);
            }
        }

        return view('pages.booking.costumer.index', compact('booking'));
    }

    function periodeCetak()
    {
        return view('pages.booking.admin.periodeCetak');
    }

    public function tableCetak(Request $request)
    {
        $validated = $request->validate([
            'bulan_dari' => 'nullable|integer|between:1,12',
            'bulan_ke' => 'nullable|integer|between:1,12',
            'tahun_dari' => 'nullable|integer|min:2000',
            'tahun_ke' => 'nullable|integer|min:2000',
        ]);

        $bulanDari = $validated['bulan_dari'] ?? null;
        $bulanKe = $validated['bulan_ke'] ?? null;
        $tahunDari = $validated['tahun_dari'] ?? null;
        $tahunKe = $validated['tahun_ke'] ?? null;

        $bookings = Booking::query();

        if ($bulanDari && $bulanKe && $tahunDari && $tahunKe) {
            $startDate = \Carbon\Carbon::create($tahunDari, $bulanDari, 1)->startOfMonth();
            $endDate = \Carbon\Carbon::create($tahunKe, $bulanKe, 1)->endOfMonth();

            $bookings = $bookings->whereBetween('tanggal_booking', [$startDate, $endDate]);
        }

        $bookings = $bookings->where('status', 'setujui')
            ->whereNotNull('buktiTransaksi')
            ->where('buktiTransaksi', '!=', '')
            ->get();

        return view('pages.booking.admin.tablecetak', compact('bookings', 'bulanDari', 'bulanKe', 'tahunDari', 'tahunKe'));
    }

    public function store(Request $request)
    {
        //
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
