<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{

    function dataBooking()
    {
        $data = Booking::all();

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
            'upload_file' => 'nullable|file|mimes:jpg,png,pdf|max:2048',
            'tanggal_booking' => 'required|date',
        ]);

        $image = $request->file('buktiTransaksi');
        $imageName = date('dmY') . time() . '_' . $image->getClientOriginalName();

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
            'buktiTransaksi' => $image->storeAs('upload/bukti', $imageName, 'public'),
            'uploadKopSurat' => $fileName,
            'tanggal_booking' => $request->tanggal_booking,
            'status' => 'menunggu',
        ]);

        return redirect()->back()->with('success', 'Booking berhasil disimpan.');
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
