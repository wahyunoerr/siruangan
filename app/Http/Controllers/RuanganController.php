<?php

namespace App\Http\Controllers;

use App\Models\Ruangan;
use Illuminate\Http\Request;

class RuanganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ruangans = Ruangan::all();

        $title = 'Delete Ruangan!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);

        return view('pages.ruangan.index', compact('ruangans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.ruangan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kd_ruangan' => 'required|unique:ruangans,kd_ruangan|min:5|max:25',
            'nama_ruangan' => 'required|string|min:1',
        ]);

        Ruangan::create([
            'kd_ruangan' => $request->kd_ruangan,
            'nama_ruangan' => $request->nama_ruangan,
        ]);

        return redirect()->route('ruangan.index')
            ->with('success', 'Data added successfully!');
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
        $ruangan = Ruangan::findOrFail($id);

        return view('pages.ruangan.edit', compact('ruangan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $ruangan = Ruangan::findOrFail($id);

        $request->validate([
            'kd_ruangan' => 'sometimes|unique:ruangans,kd_ruangan,' . $id . '|min:5|max:25',
            'nama_ruangan' => 'sometimes|string|min:1',
        ]);

        $ruangan->update([
            'kd_ruangan' => $request->kd_ruangan,
            'nama_ruangan' => $request->nama_ruangan,
        ]);

        return redirect()->route('ruangan.index')
            ->with('success', 'Data updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $ruangan = Ruangan::findOrFail($id);

        $ruangan->delete();

        return redirect()->back()
            ->with('success', 'Data deleted successfully!');
    }
}
