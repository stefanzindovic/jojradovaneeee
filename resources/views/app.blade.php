<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <!-- Primary Meta Tags -->
    <title>@yield('page_title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="title" content="Volt - Free Bootstrap 5 Dashboard">

    <link rel="icon" href="{{asset('imgs/Intelectologo.svg')}}" type="image/svg+xml" sizes="32x32">

    <x-styles></x-styles>
    @yield('style')

    <!-- NOTICE: You can use the _analytics.html partial to include production code specific code & trackers -->

</head>

<body>

<!-- NOTICE: You can use the _analytics.html partial to include production code specific code & trackers -->

<x-sidebar></x-sidebar>


<main class="content">

    <x-header></x-header>
    <div class="row">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center py-4">
            <div class="d-block mb-4 mb-md-0">
                <x-breadcrumb></x-breadcrumb>
                <h2 class="h4">@yield('page_title')</h2>
            </div>
            @yield('interaction')
        </div>
    </div>
    @yield('page_content')
</main>

<!-- Core -->
<x-scripts></x-scripts>
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
    </script>
@endif
{{Session::forget('createMessage')}}
@if (session('editMessage'))
    <script>
        notyf.success("{{ Session::get('editMessage') }}");
    </script>
@endif
{{Session::forget('editMessage')}}
@if (session('deleteMessage'))
    <script>
        notyf.success("{{ Session::get('deleteMessage') }}");
    </script>
@endif
{{Session::forget('deleteMessage')}}
@if (session('successMessage'))
    <script>
        notyf.success("{{ Session::get('successMessage') }}");
    </script>
@endif
{{Session::forget('successMessage')}}
@if (session('errorMessage'))
    <script>
        notyf.error("{{ Session::get('errorMessage') }}");
    </script>
@endif
{{Session::forget('errorMessage')}}

@yield('pre-scripts')
@yield('scripts')



</body>

</html>
