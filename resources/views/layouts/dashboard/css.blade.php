<!-- Fonts and icons -->
<script src="{{ asset('assets/dashboard/js/plugin/webfont/webfont.min.js') }}"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<script>
    WebFont.load({
        google: {
            families: ["Public Sans:300,400,500,600,700"]
        },
        custom: {
            families: [
                "Font Awesome 5 Solid",
                "Font Awesome 5 Regular",
                "Font Awesome 5 Brands",
                "simple-line-icons",
            ],
            urls: ["{{ asset('assets/dashboard/css/fonts.min.css') }}"],
        },
        active: function() {
            sessionStorage.fonts = true;
        },
    });
</script>

<!-- CSS Files -->
<link rel="stylesheet" href="{{ asset('assets/dashboard/css/bootstrap.min.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/dashboard/css/plugins.min.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/dashboard/css/kaiadmin.min.css') }}" />

<!-- CSS Just for demo purpose, don't include it in your project -->
<link rel="stylesheet" href="{{ asset('assets/dashboard/css/demo.css') }}" />
