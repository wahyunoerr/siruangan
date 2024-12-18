<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Jadwal;
use App\Models\Ruangan;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ruangan = Ruangan::all();
        $event = Event::all();
        $jadwal = Jadwal::all();

        $title = 'Delete Jadwal!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);


        return view('welcome', compact('ruangan', 'event', 'jadwal'));
    }


    function search(Request $request)
    {
        $search = $request->search;
        $ruangan = Ruangan::where('nama_ruangan', 'like', '%' . $search . '%')->get();
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
