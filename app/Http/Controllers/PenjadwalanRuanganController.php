<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\PenjadwalanRuangan;
use App\Models\Ruangan;
use Illuminate\Http\Request;

class PenjadwalanRuanganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $penjadwalanR = PenjadwalanRuangan::with('jadwal', 'ruangan')->latest()->get();

        $title = 'Delete Penjadwalan!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);

        return view('pages.penjadwalanruangan.index', compact('penjadwalanR'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $jadwal = Jadwal::all();
        $ruangan = Ruangan::all();

        return view('pages.penjadwalanruangan.create', compact('jadwal', 'ruangan'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'ruangan_id' => 'required|exists:ruangans,id',
            'jadwal_id' => 'required|exists:jadwals,id',
            'fasilitas' => 'required',
            'harga' => 'required',
            'status' => 'required|in:Boking,Belum Diboking',
            'publish' => 'required|in:published,dispublish',
        ]);

        PenjadwalanRuangan::create([
            'ruangan_id' => $request->ruangan_id,
            'jadwal_id' => $request->jadwal_id,
            'fasilitas' => $request->fasilitas,
            'harga' => $request->harga,
            'status' => $request->status,
            'publish' => $request->publish
        ]);

        return redirect()->route('penjadwalan.index')->with('success', 'Data added successfully!');
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