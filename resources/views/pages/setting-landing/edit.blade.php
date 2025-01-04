@extends('layouts.dashboard.app', ['title' => 'Edit Landing Page Entry'])

@section('content')
    <div class="container">
        <h1>Edit Landing Page Entry</h1>
        <form action="{{ route('landing.update', $landing->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ $landing->title }}" required>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" name="description" rows="3" required>{{ $landing->description }}</textarea>
            </div>
            <div class="form-group">
                <label for="full_image">Full Image</label>
                <input type="file" class="form-control-file" id="full_image" name="full_image">
                <img src="{{ asset('storage/' . $landing->full_image) }}" alt="Full Image" class="img-thumbnail mt-2"
                    width="150">
            </div>
            <div class="form-group">
                <label for="description_image">Description Image</label>
                <input type="file" class="form-control-file" id="description_image" name="description_image">
                <img src="{{ asset('storage/' . $landing->description_image) }}" alt="Description Image"
                    class="img-thumbnail mt-2" width="150">
            </div>
            <div class="form-group">
                <label for="room_image">Room Image</label>
                <input type="file" class="form-control-file" id="room_image" name="room_image">
                <img src="{{ asset('storage/' . $landing->room_image) }}" alt="Room Image" class="img-thumbnail mt-2"
                    width="150">
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
