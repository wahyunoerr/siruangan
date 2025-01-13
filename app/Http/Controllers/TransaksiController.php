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
        $transaksi = Transaksi::with('ruangan', 'booking', 'user', 'event')->get();
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
        $transaksi = Transaksi::with(['user', 'event', 'ruangan'])->findOrFail($id);
        return view('pages.transaksi.invoice', compact('transaksi'));
    }

    public function printUserInvoice($bookingId)
    {
        $booking = Booking::with(['transaksi' => function ($query) {
            $query->with(['event', 'ruangan', 'user']);
        }])
            ->where('user_id', '=', auth()->id())
            ->where('id', $bookingId)
            ->first();

        if ($booking && $booking->transaksi) {
            $transaksi = $booking->transaksi;
        } else {
            return redirect()->route('pengajuan.booking')->with('warning', 'Invoice belum bisa dicetak karna menunggu persetujuan admin');
        }

        return view('pages.booking.costumer.invoice', compact('transaksi'));
    }

    public function inputDp(Request $request, $id)
    {
        $request->validate([
            'dp' => 'required|numeric',
        ]);

        $booking = Booking::findOrFail($id);
        $dp = $request->input('dp');
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

        return redirect()->route('transaksi')->with('success', 'DP berhasil diinput.');
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
