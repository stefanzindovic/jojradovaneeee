<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Online biblioteka | @yield('page_title')</title>

    <link rel="icon" type="image/x-icon" href="{{ asset('imgs/library-favicon.ico') }}">

    <x-styles></x-styles>
</head>

<body>
    <!-- Header navigation -->
    <x-header></x-header>

    <main class="flex flex-row small:hidden">
        <!-- Sidebar navigation -->
        <x-sidebar></x-sidebar>

        <!-- Page content -->
        @yield('page_content')
    </main>

    <x-inProgress></x-inProgress>
    <x-scripts></x-scripts>
</body>

</html>
