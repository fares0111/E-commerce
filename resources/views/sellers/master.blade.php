<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Default Title')</title>
    <link rel="stylesheet" href="{{ asset('css/sellers/layout.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sellers/partials/side-bar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sellers/partials/top-bar.css') }}">

</head>
<body>
    <!-- Sidebar -->
    @include('sellers.partials.side-bar')

    <!-- Main Content -->
    <div class="main-content" style="margin-left: 250px; padding: 20px;">
        @include('sellers.partials.top-bar') <!-- توب بار -->
        <div class="container">
         
           @yield('content') <!-- محتوى الصفحة -->
        </div>
        
        @include('sellers.partials.footer') <!-- فوتر -->
    </div>
</body>
</html>
