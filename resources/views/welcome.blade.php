@extends('layouts.landing.app')
@section('title', 'Selamat Datang!')
@section('content')

    <!-- Services Section -->
    <section id="services" class="services section">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>Ruangan</h2>
            <div class="input-group rounded">
                <input type="search" class="form-control rounded" placeholder="Search" aria-label="Search"
                    aria-describedby="search-addon" />
            </div>

        </div><!-- End Section Title -->

        <div class="container" data-aos="fade-up" data-aos-delay="100">

            <div class="row gy-5">

                @foreach ($penjadwalan as $item)
                    <div class="col-xl-4 col-md-6" data-aos="zoom-in" data-aos-delay="200">
                        <div class="service-item">
                            <div class="img">
                                <img src="{{ Storage::disk('public')->url($item->ruangan->thumbnail) }}" class="img-fluid"
                                    alt="">
                            </div>
                            <div class="details position-relative">
                                <div class="icon">
                                    <i class="bi bi-calendar4-week"></i>
                                </div>
                                <a href="service-details.html" class="stretched-link">
                                    <h3>{{ $item->ruangan->nama_ruangan }}</h3>
                                </a>
                                <p>
                                    Status : @if ($item->status == 'Belum Diboking')
                                        <span class="badge bg-danger">Belum Diboking</span>
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>

        </div>

    </section><!-- /Services Section -->
@endsection
