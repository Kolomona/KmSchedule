<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('partials._head')
</head>

<body>
    <div id="app">
        @include('partials._navBar')
        <main class="py-4">
            @include('partials._messages')
            @yield('content')
        </main>
    </div>
    @include('partials._footer')
    @include('partials._scripts')
</body>

</html>