<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Ruangan - Universitas Muhammadiyah Riau</title>
    <link rel="stylesheet" href="{{ asset('assets/landing/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/landing/css/styleLanding.css') }}">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top">
        <a class="navbar-brand" href="#">UMRI</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item"><a class="nav-link" href="#">Beranda</a></li>
                <li class="nav-item"><a class="nav-link" href="#description">Deskripsi</a></li>
                <li class="nav-item"><a class="nav-link" href="#details">Ruangan</a></li>
                <li class="nav-item"><a class="nav-link" href="#schedule">Jadwal</a></li>
                <li class="nav-item"><a class="nav-link btn btn-primary text-white" href="#booking">Booking Sekarang</a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                @guest
                    <li class="nav-item"><a id="join-us" class="nav-link" href="{{ route('register') }}">Join Us</a></li>
                @else
                    @if (Auth::user()->hasRole('Administrator') || Auth::user()->hasRole('Perlengkapan'))
                        <li class="nav-item"><a id="join-us" class="nav-link"
                                href="{{ route('dashboard') }}">Dashboard</a></li>
                    @elseif(Auth::user()->hasRole('Costumer'))
                        <li class="nav-item"><a id="join-us" class="nav-link"
                                href="{{ route('costumer.formBoking') }}">Booking Sekarang</a></li>
                    @endif
                @endguest
            </ul>
        </div>
    </nav>

    <div class="container-fluid p-0">
        @if ($landings->isNotEmpty())
            <img src="{{ asset('storage/' . $landings->first()->full_image) }}" class="img-fluid w-100"
                style="height: 100vh; object-fit: cover;" alt="Full Image">
        @else
            <p>Setting landing page anda</p>
        @endif
    </div>

    <section id="description" class="container mt-5 animate-bottom scroll-offset scroll-animate">
        <div class="card">
            <div class="row no-gutters">
                <div class="col-md-4">
                    @if ($landings->isNotEmpty())
                        <img src="{{ asset('storage/' . $landings->first()->description_image) }}"
                            class="card-img img-fluid w-100" alt="Deskripsi Image">
                    @else
                        <img src="https://via.placeholder.com/800x400" class="card-img img-fluid w-100"
                            alt="Deskripsi Image">
                    @endif
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h2 class="card-title">Deskripsi</h2>
                        @if ($landings->isNotEmpty())
                            <p class="card-text mt-3">{{ $landings->first()->description }}</p>
                        @else
                            <p class="card-text mt-3">Setting landing page anda</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="details" class="container mt-5 animate-bottom scroll-offset scroll-animate">
        <div class="card">
            <div class="row no-gutters">
                <div class="col-md-4">
                    @if ($landings->isNotEmpty())
                        <img src="{{ asset('storage/' . $landings->first()->room_image) }}"
                            class="card-img img-fluid w-100" alt="Ruangan Image">
                    @else
                        <p>Setting landing page anda</p>
                    @endif
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h2 class="card-title">Ruangan</h2>
                        <p class="card-text mt-3"><strong>Kapasitas:</strong> 300 orang</p>
                        <p class="card-text"><strong>Fasilitas:</strong> kursi dan meja, AC, speaker dan mic, smart tv,
                            proyektor</p>
                        <p class="card-text"><strong>Jam Penyewaan:</strong> 08.00-17.00</p>
                        <div class="row mt-3">
                            <div class="col-md-12 mt-3">
                                <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                                    <div class="carousel-indicators">
                                        @foreach ($carouselImages as $index => $img)
                                            <button type="button" data-bs-target="#carouselExampleIndicators"
                                                data-bs-slide-to="{{ $index }}"
                                                class="{{ $index == 0 ? 'active' : '' }}"
                                                aria-current="{{ $index == 0 ? 'true' : 'false' }}"
                                                aria-label="Slide {{ $index + 1 }}"></button>
                                        @endforeach
                                    </div>
                                    <div class="carousel-inner">
                                        @foreach ($carouselImages as $index => $img)
                                            <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                                <img src="{{ asset('storage/' . $img) }}"
                                                    class="d-block w-100 carousel-image"
                                                    alt="Detail Image {{ $index + 1 }}">
                                            </div>
                                        @endforeach
                                    </div>
                                    <button class="carousel-control-prev" type="button"
                                        data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Previous</span>
                                    </button>
                                    <button class="carousel-control-next" type="button"
                                        data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Next</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="schedule" class="container mt-5 animate-bottom scroll-offset scroll-animate">
        <div class="card">
            <div class="card-body">
                <h2 class="card-title">Jadwal Ruangan</h2>
                <div class="table-responsive">
                    <table class="table table-striped mt-3" id="scheduleTable">
                        <thead>
                            <tr>
                                <th scope="col">Hari</th>
                                <th scope="col">Tanggal</th>
                                <th scope="col">Waktu</th>
                                <th scope="col">Ruangan</th>
                                <th scope="col">Kegiatan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Rabu</td>
                                <td>01/11/2023</td>
                                <td>08:00 - 10:00</td>
                                <td>Ruang A</td>
                                <td>Seminar Teknologi</td>
                            </tr>
                            <tr>
                                <td>Kamis</td>
                                <td>02/11/2023</td>
                                <td>10:00 - 12:00</td>
                                <td>Ruang B</td>
                                <td>Workshop Kewirausahaan</td>
                            </tr>
                            <tr>
                                <td>Jumat</td>
                                <td>03/11/2023</td>
                                <td>13:00 - 15:00</td>
                                <td>Ruang C</td>
                                <td>Program Tahfidz Al-Qur'an</td>
                            </tr>
                        </tbody>
                    </table>
                    <nav>
                        <ul class="pagination justify-content-center" id="pagination">
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </section>

    <section id="events" class="container mt-5 animate-bottom scroll-offset scroll-animate">
        <div class="card">
            <div class="card-body">
                <h2 class="card-title" style="border-bottom: 2px solid; border-radius: 15px;">Acara</h2>
                <div class="row">
                    @if ($event)
                        @foreach ($event as $e)
                            <div class="col-md-4 mt-3">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $e->name }}</h5>
                                        <hr style="border-bottom: 2px solid; border-radius: 15px;">
                                        <p class="card-text">Harga: Rp {{ number_format($e->harga, 0, ',', '.') }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <p>No events available.</p>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <section id="booking" class="container mt-5 animate-bottom scroll-offset scroll-animate">
        <div class="card">
            <div class="card-body text-center">
                @guest
                    <a href="{{ route('login') }}" class="btn btn-primary">Login untuk Booking</a>
                @else
                    <a href="{{ route('costumer.formBoking') }}" class="btn btn-primary">Booking Sekarang</a>
                @endguest
            </div>
        </div>
    </section>

    <footer>
        <p>&copy; 2023 Universitas Muhammadiyah Riau. All rights reserved.</p>
        <p>Hubungi kami untuk informasi lebih lanjut dan pemesanan ruangan.</p>
    </footer>
    <div class="modal fade" id="imagePreviewModal" tabindex="-1" aria-labelledby="imagePreviewModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="imagePreviewModalLabel">Image Preview</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <img id="previewImage" src="" alt="Preview Image">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="zoomIn">Zoom In</button>
                    <button type="button" class="btn btn-secondary" id="zoomOut">Zoom Out</button>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('assets/landing/js/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('assets/landing/js/bootstrap.bundle.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('.navbar-toggler').click(function() {
                $('#navbarNav').collapse('toggle');
            });

            let scale = 1;
            const scaleStep = 0.1;

            $('.carousel-image').click(function() {
                const src = $(this).attr('src');
                $('#previewImage').attr('src', src);
                $('#imagePreviewModal').modal('show');
            });

            $('#zoomIn').click(function() {
                scale += scaleStep;
                $('#previewImage').css('transform', `scale(${scale})`);
            });

            $('#zoomOut').click(function() {
                scale = Math.max(1, scale - scaleStep);
                $('#previewImage').css('transform', `scale(${scale})`);
            });

            $('#imagePreviewModal').on('hidden.bs.modal', function() {
                scale = 1;
                $('#previewImage').css('transform', 'scale(1)');
            });
            const rowsPerPage = 5;
            const rows = $('#scheduleTable tbody tr');
            const rowsCount = rows.length;
            const pageCount = Math.ceil(rowsCount / rowsPerPage);
            const pagination = $('#pagination');

            for (let i = 1; i <= pageCount; i++) {
                pagination.append(`<li class="page-item"><a class="page-link" href="#">${i}</a></li>`);
            }

            pagination.find('li:first-child').addClass('active');
            displayRows(1);

            pagination.find('li').click(function() {
                const pageNum = $(this).index() + 1;
                pagination.find('li').removeClass('active');
                $(this).addClass('active');
                displayRows(pageNum);
            });

            function displayRows(pageNum) {
                const start = (pageNum - 1) * rowsPerPage;
                const end = start + rowsPerPage;
                rows.hide();
                rows.slice(start, end).show();
            }

            function animateOnScroll() {
                $('.scroll-animate').each(function() {
                    if ($(this).offset().top < $(window).scrollTop() + $(window).height() - 100) {
                        $(this).addClass('animate');
                    }
                });
            }

            $(window).on('scroll', animateOnScroll);
            animateOnScroll();

            $('a.nav-link').click(function(event) {
                if (this.hash !== "") {
                    event.preventDefault();
                    const hash = this.hash;
                    $('html, body').animate({
                        scrollTop: $(hash).offset().top
                    }, 800, function() {
                        window.location.hash = hash;
                    });
                }
            });
        });
    </script>
</body>

</html>
