<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Event;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
            $data = Booking::with(['user', 'event', 'jadwal', 'ruangan'])->latest()->get();
        }


        return view('pages.booking.admin.index', compact('data'));
    }

    public function simpanBokingCostumer(Request $request)
    {
        $eventName = Event::find($request->event_id)->name ?? '';

        $rules = [
            'user_id' => 'required|exists:users,id',
            'event_id' => 'required|exists:event,id',
            'jadwal_id' => 'required|exists:jadwals,id',
            'ruangan_id' => 'required|exists:ruangans,id',
            'tanggal_booking' => 'required',
        ];

        if ($eventName === 'Seminar' | $eventName === 'Perpisahan Sekolah' | $eventName === 'Tahfiz Quran') {
            $rules['upload_file'] = 'required|file|mimes:docx,pdf|max:2048';
        } else {
            $rules['buktiTransaksi'] = 'required|file|mimes:jpg,png,jpeg|max:2048';
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
            'jadwal_id' => 'jadwal',
            'ruangan_id' => 'ruangan',
            'tanggal_booking' => 'tanggal booking',
            'buktiTransaksi' => 'bukti transaksi',
            'upload_file' => 'file kop surat',
        ];

        $request->validate($rules, $messages, $attributes);

        $isBooked = Booking::where('tanggal_booking', $request->tanggal_booking)
            ->where('jadwal_id', $request->jadwal_id)
            ->where('ruangan_id', $request->ruangan_id)
            ->where('status', '!=', 'tolak')
            ->exists();

        if ($isBooked) {
            return redirect()->back()->withErrors(['tanggal_booking' => 'Jadwal dan ruangan ini sudah dibooking untuk tanggal tersebut.']);
        }

        $imageName = null;
        if ($request->hasFile('buktiTransaksi')) {
            $image = $request->file('buktiTransaksi');
            $imageName = date('dmY') . time() . '_' . $image->getClientOriginalName();
            $imageName = $image->storeAs('upload/bukti', $imageName, 'public');
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
            'jadwal_id' => $request->jadwal_id,
            'ruangan_id' => $request->ruangan_id,
            'buktiTransaksi' => $imageName,
            'uploadKopSurat' => $fileName,
            'tanggal_booking' => $request->tanggal_booking,
            'status' => 'menunggu',
        ]);

        return redirect()->route('pengajuan.booking')->with('success', 'Booking berhasil disimpan.');
    }

    public function updateStatus(Request $request, $id)
    {
        $userRole = auth()->user()->roles->pluck('name')->first();

        $rules = [
            'status' => 'required|in:setujui,tolak,menunggu',
        ];

        if ($userRole === 'Administrator' && $request->input('status') === 'setujui') {
            $rules['dp'] = 'required|numeric';
        }

        $request->validate($rules);

        $booking = Booking::with(['event'])->findOrFail($id);

        if (in_array($booking->event->name, ['Tahfiz Quran', 'Seminar', 'Perpisahan Sekolah'])) {
            if ($booking->uploadKopSurat) {
                if ($userRole === 'Administrator' && $request->input('status') === 'setujui') {
                    $this->createTransaksi($booking, $request->input('dp'));
                }
                $booking->status = $request->input('status');
                $booking->save();

                return $this->redirectAfterUpdate($userRole);
            } else {
                return redirect()->back()->with('error', 'Kop surat wajib diunggah untuk jenis acara ini!');
            }
        } else {
            if ($userRole === 'Administrator' && $request->input('status') === 'setujui') {
                $this->createTransaksi($booking, $request->input('dp'));
            }
            $booking->status = $request->input('status');
            $booking->save();

            return $this->redirectAfterUpdate($userRole);
        }
    }

    private function createTransaksi($booking, $dp)
    {
        $sisaPelunasan = $booking->event->harga - $dp;

        Transaksi::create([
            'booking_id' => $booking->id,
            'user_id' => $booking->user_id,
            'event_id' => $booking->event_id,
            'jadwal_id' => $booking->jadwal_id,
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

        return redirect()->back()->with('success', 'Berkas berhasil diunggah.');
    }

    /**
     * Display a listing of the resource.
     */
    public function indexBookingCostumer()
    {

        $booking = Booking::with(['jadwal', 'event', 'ruangan'])
            ->where('user_id', auth()->id())
            ->get();

        return view('pages.booking.costumer.index', compact('booking'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
