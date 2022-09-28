<!-- Vendor JS Files -->
<script src="{{ asset('assets/vendor/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ asset('userside/vendor/purecounter/purecounter_vanilla.js') }}"></script>
<script src="{{ asset('userside/vendor/aos/aos.js') }}"></script>
<script src="{{ asset('userside/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('userside/vendor/glightbox/js/glightbox.min.js') }}"></script>
<script src="{{ asset('userside/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
<script src="{{ asset('userside/vendor/swiper/swiper-bundle.min.js') }}"></script>
<script src="{{ asset('userside/vendor/php-email-form/validate.js') }}"></script>
<script src="{{ asset('userside/js/usersideFilters.js') }}"></script>
<!-- Template Main JS File -->
<script src="{{ asset('userside/js/main.js') }}"></script>

<script src="{{ asset('userside/vendor/notyf/notyf.min.js') }}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bodymovin/5.7.4/lottie.min.js"></script>
<script>
    var notyf = new Notyf();
    var animation = bodymovin.loadAnimation({
        // animationData: { /* ... */ },
        container: document.getElementById('icon-container'), // required
        path: "{{ asset('userside/img/online.json') }}", // required
        renderer: 'svg', // required
        loop: false, // optional
        autoplay: true, // optional
        name: "Icon", // optional
    });
</script>

@if ($errors->any())
    <script>
        @foreach ($errors->all() as $error)
            notyf.error("{{ $error }}");
        @endforeach
    </script>
@endif

@if (session('createMessage'))
    <script>
        notyf.success("{{ Session::get('createMessage') }}");
        {{ Session::forget('createMessage') }}
    </script>
@endif
@if (session('editMessage'))
    <script>
        notyf.success("{{ Session::get('editMessage') }}");
        {{ Session::forget('editMessage') }}
    </script>
@endif
@if (session('successMessage'))
    <script>
        notyf.success("{{ Session::get('successMessage') }}");
        {{ Session::forget('succcessMessage') }}
    </script>
@endif
@if (session('errorMessage'))
    <script>
        notyf.error("{{ Session::get('errorMessage') }}");
        {{ Session::forget('errorMessage') }}
    </script>
@endif
