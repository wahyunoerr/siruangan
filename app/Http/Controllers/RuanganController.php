<?php

namespace App\Http\Controllers;

use App\Models\Ruangan;
use App\Models\UploadImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
            'images.*' => 'nullable|mimes:png,jpg,jpeg',
            'status' => 'required|in:Sudah Dibooking,Belum Dibooking',
            'keterangan' => 'nullable|string',
            'videos' => 'nullable|mimes:mp4,mov,avi|max:20000'
        ]);

        $images = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $imageName = time() . '_' . $file->getClientOriginalName();
                $images[] = $file->storeAs('upload/image', $imageName, 'public');
            }
        }

        $videoPath = null;
        if ($request->hasFile('videos')) {
            $videoFile = $request->file('videos');
            $videoName = time() . '_' . $videoFile->getClientOriginalName();
            $videoPath = $videoFile->storeAs('upload/videos', $videoName, 'public');
        }

        $ruangan = Ruangan::create([
            'kd_ruangan' => $request->kd_ruangan,
            'nama_ruangan' => $request->nama_ruangan,
            'status' => $request->status,
            'keterangan' => $request->keterangan,
            'videos' => $videoPath,
            'images' => json_encode($images)
        ]);

        UploadImage::create([
            'ruangan_id' => $ruangan->id,
            'images' => json_encode($images)
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
        $uploadImage = UploadImage::where('ruangan_id', $ruangan->id)->first();
        $existingImages = json_decode($uploadImage->images, true) ?? [];

        return view('pages.ruangan.edit', compact('ruangan', 'existingImages'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'kd_ruangan' => 'required|min:5|max:25|unique:ruangans,kd_ruangan,' . $id,
            'nama_ruangan' => 'required|string|min:1',
            'images.*' => 'nullable|mimes:png,jpg,jpeg',
            'status' => 'required|in:Sudah Dibooking,Belum Dibooking',
            'keterangan' => 'nullable|string',
            'videos' => 'nullable|mimes:mp4,mov,avi|max:20000'
        ]);

        $ruangan = Ruangan::findOrFail($id);

        if ($request->hasFile('images')) {
            $existingImages = json_decode($ruangan->images, true);
            foreach ($existingImages as $image) {
                Storage::disk('public')->delete($image);
            }
            $images = [];
            foreach ($request->file('images') as $file) {
                $imageName = time() . '_' . $file->getClientOriginalName();
                $images[] = $file->storeAs('upload/image', $imageName, 'public');
            }
        } else {
            $images = json_decode($ruangan->images, true);
        }

        $videoPath = $ruangan->videos;
        if ($request->hasFile('videos')) {
            $videoFile = $request->file('videos');
            $videoName = time() . '_' . $videoFile->getClientOriginalName();
            $videoPath = $videoFile->storeAs('upload/videos', $videoName, 'public');
        }

        $ruangan->update([
            'kd_ruangan' => $request->kd_ruangan,
            'nama_ruangan' => $request->nama_ruangan,
            'status' => $request->status,
            'keterangan' => $request->keterangan,
            'videos' => $videoPath,
            'images' => json_encode($images)
        ]);

        $uploadImage = UploadImage::where('ruangan_id', $ruangan->id)->first();
        $uploadImage->update([
            'images' => json_encode($images)
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

        $images = UploadImage::where('ruangan_id', $ruangan->id)->first();
        foreach (json_decode($images->images) as $image) {
            Storage::disk('public')->delete($image);
        }

        $ruangan->delete();

        return redirect()->back()->with('success', 'Data berhasil dihapus.');
    }
}
