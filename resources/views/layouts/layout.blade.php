<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        @yield('title')
    </title>
    @vite('resources/css/app.css')
</head>
<body>
<div class="container">
    @include('partials.header')
    @include('partials.nav')
    @yield('content')
    @include('partials.footer')
</div>
</body>
</html>
