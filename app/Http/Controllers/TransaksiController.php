<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Transaksi;
use App\Models\User;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transaksi = Transaksi::with('ruangan', 'booking', 'jadwal', 'user', 'event')->get();
        return view('pages.transaksi.index', compact('transaksi'));
    }

    public function uploadBukti(Request $request, $id)
    {
        $request->validate([
            'buktiPelunasan' => 'required|file|mimes:jpeg,png,pdf|max:2048',
        ]);

        $file = $request->file('buktiPelunasan');
        $imageName = time() . '_' . $file->getClientOriginalName();

        $transaksi = Transaksi::findOrFail($id);

        $filePath = $file->storeAs('upload/image', $imageName, 'public');
        $transaksi->update([
            'buktiPelunasan' => $filePath,
            'status' => 'Lunas'
        ]);

        return redirect()->route('transaksi')->with('success', 'Bukti transaksi berhasil diunggah!');
    }

    public function printInvoice($id)
    {
        $transaksi = Transaksi::with(['user', 'event', 'ruangan', 'jadwal'])->findOrFail($id);
        return view('pages.transaksi.invoice', compact('transaksi'));
    }

    public function printUserInvoice($bookingId)
    {
        // Mengambil transaksi berdasarkan ID booking, dan memastikan ID user yang login
        $booking = Booking::with(['transaksi' => function ($query) {
            $query->with(['event', 'ruangan', 'jadwal', 'user']);
        }])
            ->where('user_id', '=', auth()->id())  // Pastikan pengguna yang login
            ->where('id', $bookingId)  // ID booking yang diterima
            ->first();

        if ($booking && $booking->transaksi) {
            $transaksi = $booking->transaksi;
        } else {
            // Tangani jika transaksi tidak ditemukan atau booking tidak ditemukan
            return redirect()->route('booking.index')->with('error', 'Invoice tidak ditemukan.');
        }

        return view('pages.booking.costumer.invoice', compact('transaksi'));
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
