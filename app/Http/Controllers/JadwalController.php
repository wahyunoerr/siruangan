<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jadwals = Jadwal::all();

        $title = 'Delete Jadwal!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);

        return view('pages.jadwal.index', compact('jadwals'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.jadwal.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'hari' => 'required',
            'waktuMulai' => 'required',
            'waktuSelesai' => 'required',
            'status' => 'required|in:Tersedia,Tidak Tersedia'
        ]);

        Jadwal::create([
            'day' => $request->hari,
            'waktuMulai' => $request->waktuMulai,
            'waktuSelesai' => $request->waktuSelesai,
            'status' => $request->status,
        ]);

        return redirect()->route('jadwal.index')->with('success', 'Data added successfully!');
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
        $jadwal = Jadwal::findOrFail($id);

        return view('pages.jadwal.edit', compact('jadwal'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $jadwal = Jadwal::findOrFail($id);

        $request->validate([
            'hari' => 'required',
            'waktuMulai' => 'required',
            'waktuSelesai' => 'required',
            'status' => 'required|in:Tersedia,Tidak Tersedia'
        ]);

        $jadwal->update([
            'day' => $request->hari,
            'waktuMulai' => $request->waktuMulai,
            'waktuSelesai' => $request->waktuSelesai,
            'status' => $request->status,
        ]);

        return redirect()->route('jadwal.index')
            ->with('success', 'Data updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $jadwal = Jadwal::findOrFail($id);
        $jadwal->delete();
        return redirect()->back()->with('success', 'Data deleted successfully!');
    }
}
