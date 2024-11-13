@extends('layouts.landing.app')
@section('title', 'Selamat Datang!')
@section('content')
    <div class="text-center mb-4">
        <h2>Booking Ruangan</h2>
    </div>
    <div class="input-group mb-3">
        <input type="text" class="form-control" placeholder="Search" aria-label="Search">
        <button class="btn btn-sm btn-outline-danger" type="button"><i class="fa fa-search"></i></button>
    </div>

    @forelse ($ruangan as $item)
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-4">
                <div class="card">
                    <img src="{{ Storage::disk('public')->url($item->thumbnail) }}" class="card-img-top" alt="Room Image">
                    <div class="card-body text-center">
                        <div class="position-relative">
                            <div class="position-absolute top-0 start-50 translate-middle">
                                <div class="bg-primary text-white rounded-circle p-3">
                                    <i class="fas fa-calendar-alt"></i>
                                </div>
                            </div>
                        </div>
                        <h5 class="mt-5">Ruangan A</h5>
                        <p>Status:
                            @if ($item->status == 'Sudah Booking')
                                <span class="badge bg-success">Sudah Dibooking</span>
                            @else
                                <span class="badge bg-warning">Belum Dibooking</span>
                            @endif
                        </p>
                        @auth
                            @if (auth()->user()->hasRole('Costumer'))
                                <button type="button" class="btn bg-primary text-white" data-bs-toggle="modal"
                                    data-bs-target="#bookingModal" data-id="{{ $item->id }}">Pesan</button>
                            @else
                                <button type="button" class="btn bg-secondary text-white" disabled>Login sebagai Costumer untuk
                                    Pesan</button>
                            @endif
                        @else
                            <a href="{{ route('login') }}" class="btn bg-secondary text-white">Login untuk Pesan</a>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-4">
                <div class="card">
                    <img src="https://via.placeholder.com/350x150" class="card-img-top" alt="Room Image">
                    <div class="card-body text-center">
                        <div class="position-relative">
                            <div class="position-absolute top-0 start-50 translate-middle">
                                <div class="bg-primary text-white rounded-circle p-3">
                                    <i class="fas fa-calendar-alt"></i>
                                </div>
                            </div>
                        </div>
                        <h5 class="mt-5">Data tidak Ditemukan</h5>
                    </div>
                </div>
            </div>
        </div>
    @endforelse
@endsection
@include('boking')
