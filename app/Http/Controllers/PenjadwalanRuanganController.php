<?php

namespace App\Http\Controllers;

use App\Models\Event;
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
        $penjadwalanR = PenjadwalanRuangan::with('jadwal', 'ruangan', 'event')->latest()->get();

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
        $event = Event::all();

        return view('pages.penjadwalanruangan.create', compact('jadwal', 'ruangan', 'event'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'ruangan_id' => 'required|exists:ruangans,id',
            'jadwal_id' => 'required|exists:jadwals,id',
            'event_id' => 'required|exists:event,id',
            'fasilitas' => 'required',
            'status' => 'required|in:Boking,Belum Diboking',
            'publish' => 'required|in:published,dispublish',
        ]);

        PenjadwalanRuangan::create([
            'ruangan_id' => $request->ruangan_id,
            'jadwal_id' => $request->jadwal_id,
            'event_id' => $request->event_id,
            'fasilitas' => $request->fasilitas,
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

        $jadwal = Jadwal::all();
        $ruangan = Ruangan::all();
        $event = Event::all();


        $penjadwalan = PenjadwalanRuangan::findorfail($id);

        return view('pages.penjadwalanruangan.edit', compact('penjadwalan', 'ruangan', 'jadwal', 'event'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'ruangan_id' => 'required|exists:ruangans,id',
            'jadwal_id' => 'required|exists:jadwals,id',
            'event_id' => 'required|exists:event,id',
            'fasilitas' => 'required',
            'status' => 'required|in:Boking,Belum Diboking',
            'publish' => 'required|in:published,dispublish',
        ]);

        $penjadwalan = PenjadwalanRuangan::findorfail($id);

        $penjadwalan->update([
            'ruangan_id' => $request->ruangan_id,
            'jadwal_id' => $request->jadwal_id,
            'event_id' => $request->event_id,
            'fasilitas' => $request->fasilitas,
            'status' => $request->status,
            'publish' => $request->publish
        ]);

        return redirect()->route('penjadwalan.index')->with('success', 'Data berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $penjadwalan = PenjadwalanRuangan::findorfail($id);

        $penjadwalan->delete();

        return redirect()->back()->with('success', 'Data berhasil dihapus');
    }
}
