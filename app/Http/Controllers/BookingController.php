<?php

namespace App\Http\Controllers;

use App\Models\Booking;
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
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'event_id' => 'required|exists:event,id',
            'jadwal_id' => 'required|exists:jadwals,id',
            'ruangan_id' => 'required|exists:ruangans,id',
            'buktiTransaksi' => 'required|file|mimes:jpg,png,jpeg|max:2048',
            'upload_file' => 'nullable|file|mimes:docx,pdf|max:2048',
            'tanggal_booking' => 'required',
        ]);

        $image = $request->file('buktiTransaksi');
        $imageName = date('dmY') . time() . '_' . $image->getClientOriginalName();

        if ($request->hasFile('upload_file')) {
            $file = $request->file('upload_file');
            $fileName = date('dmY') . time() . '_' . $file->getClientOriginalName();
            $fileName = $file->storeAs('upload/kopSurat', $fileName, 'public');
        } else {
            $fileName = null;
        }

        Booking::create([
            'user_id' => $request->user_id,
            'event_id' => $request->event_id,
            'jadwal_id' => $request->jadwal_id,
            'ruangan_id' => $request->ruangan_id,
            'buktiTransaksi' => $image->storeAs('upload/bukti', $imageName, 'public'),
            'uploadKopSurat' => $fileName,
            'tanggal_booking' => $request->tanggal_booking,
            'status' => 'menunggu',
        ]);

        return redirect()->back()->with('success', 'Booking berhasil disimpan.');
    }


    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:setujui,tolak,menunggu'
        ]);

        $booking = Booking::findOrFail($id);

        if (in_array($booking->event->name, ['Tahfiz Quran', 'Seminar', 'Perpisahan Sekolah'])) {
            if ($booking->uploadKopSurat) {
                $booking->status = $request->input('status');
                $booking->save();

                return redirect('dataBooking')->with('success', 'Booking disetujui oleh perlengkapan.');
            } else {
                return redirect('dataBooking')->with('error', 'Surat persetujuan belum diunggah oleh customer.');
            }
        } else {
            $booking->status = $request->input('status');
            $booking->save();

            return redirect('dataBooking')->with('success', 'Status booking berhasil diperbarui oleh admin.');
        }
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
