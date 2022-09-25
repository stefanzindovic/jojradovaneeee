<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <!-- Primary Meta Tags -->
    <title>@yield('page_title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="title" content="Volt - Free Bootstrap 5 Dashboard">


    <x-styles></x-styles>

    <!-- NOTICE: You can use the _analytics.html partial to include production code specific code & trackers -->

</head>

<body>

<!-- NOTICE: You can use the _analytics.html partial to include production code specific code & trackers -->

<x-sidebar></x-sidebar>


<main class="content">

    <x-header></x-header>
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
@if (session('editMessage'))
    <script>
        notyf.success("{{ Session::get('editMessage') }}");
    </script>
@endif
@if (session('deleteMessage'))
    <script>
        notyf.success("{{ Session::get('deleteMessage') }}");
    </script>
@endif
@if (session('errorMessage'))
    <script>
        notyf.error("{{ Session::get('errorMessage') }}");
    </script>
@endif






</body>

</html>
