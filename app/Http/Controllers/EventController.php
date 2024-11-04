<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $event = Event::all();

        $title = 'Delete Jadwal!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);

        return view('pages.event.index', compact('event'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.event.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'harga' => 'required',
        ]);

        Event::create([
            'name' => $request->name,
            'harga' => $request->harga
        ]);

        return redirect()->route('acara.index')->with('success', 'Data berhasil disimpan');
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
        $event = Event::findorfail($id);

        return view('pages.event.edit', compact('event'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $event = Event::findorfail($id);

        $request->validate([
            'name' => 'required',
            'harga' => 'required',
        ]);


        $event->update([
            'name' => $request->name,
            'harga' => $request->harga
        ]);

        return redirect()->route('acara.index')->with('success', 'Data berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $event = Event::findorfail($id);

        $event->delete();

        return redirect()->back()->with('success', 'Data berhasil dihapus');
    }
}
