<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Ruangan;
use App\Models\Landing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class LandingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ruangan = Ruangan::with('images')->get();
        $event = Event::all();
        $landings = Landing::all();

        $carouselImages = [];
        foreach ($ruangan as $room) {
            foreach ($room->images as $image) {
                $images = json_decode($image->images, true);
                $carouselImages = array_merge($carouselImages, $images);
            }
        }

        return view('welcome', compact('ruangan', 'event', 'landings', 'carouselImages'));
    }

    public function create()
    {
        return view('pages.setting-landing.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'description' => 'required|string',
            'full_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'room_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $fullImagePath = $request->file('full_image')->store('images', 'public');
        $descriptionImagePath = $request->file('description_image')->store('images', 'public');
        $roomImagePath = $request->file('room_image')->store('images', 'public');

        Landing::create([
            'description' => $request->description,
            'full_image' => $fullImagePath,
            'description_image' => $descriptionImagePath,
            'room_image' => $roomImagePath,
        ]);

        return redirect()->route('landing.manage')->with('success', 'Entry created successfully.');
    }

    public function edit($id)
    {
        $landing = Landing::findOrFail($id);
        return view('setting-landing.edit', compact('landing'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'description' => 'required|string',
            'full_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'room_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $landing = Landing::findOrFail($id);

        if ($request->hasFile('full_image')) {
            Storage::disk('public')->delete($landing->full_image);
            $landing->full_image = $request->file('full_image')->store('images', 'public');
        }

        if ($request->hasFile('description_image')) {
            Storage::disk('public')->delete($landing->description_image);
            $landing->description_image = $request->file('description_image')->store('images', 'public');
        }

        if ($request->hasFile('room_image')) {
            Storage::disk('public')->delete($landing->room_image);
            $landing->room_image = $request->file('room_image')->store('images', 'public');
        }

        $landing->update([
            'description' => $request->description,
            'full_image' => $landing->full_image,
            'description_image' => $landing->description_image,
            'room_image' => $landing->room_image,
        ]);

        return redirect()->route('landing.manage')->with('success', 'Entry updated successfully.');
    }

    public function destroy($id)
    {
        $landing = Landing::findOrFail($id);
        Storage::disk('public')->delete($landing->full_image);
        Storage::disk('public')->delete($landing->description_image);
        Storage::disk('public')->delete($landing->room_image);
        $landing->delete();
        return redirect()->route('landing.manage')->with('success', 'Entry deleted successfully.');
    }

    public function search(Request $request)
    {
        $search = $request->search;
        $ruangan = Ruangan::where('nama_ruangan', 'like', '%' . $search . '%')->get();
        return view('welcome', compact('ruangan'));
    }

    public function manage()
    {
        $landings = Landing::all();
        return view('pages.setting-landing.index', compact('landings'));
    }
}
