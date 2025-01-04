<script src="{{ asset('assets/landing/js/jquery-3.7.1.min.js') }}"></script>
<script src="{{ asset('assets/landing/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/landing/js/bootstrap.bundle.min.js') }}"></script>
<script>
    function hidePreloader() {
        setTimeout(function() {
            document.getElementById('preloader').style.display = 'none';
        }, 2000);
    }
</script>
@stack('js-internal')
