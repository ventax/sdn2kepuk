<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @php
        $schoolLogo = \App\Helpers\SettingHelper::get('logo_image');
        $schoolFavicon = $schoolLogo ? asset('storage/' . $schoolLogo) : asset('images/logo-sdn2-kepuk.jpeg');
    @endphp
    <title>@yield('title', 'Admin Login')</title>
    <link rel="icon" type="image/jpeg" href="{{ $schoolFavicon }}">
    <link rel="shortcut icon" type="image/jpeg" href="{{ $schoolFavicon }}">
    <link rel="apple-touch-icon" href="{{ $schoolFavicon }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">
    <style>
        body {
            min-height: 100vh;
            margin: 0;
            font-family: 'Plus Jakarta Sans', sans-serif;
            background:
                radial-gradient(circle at 15% 20%, rgba(20, 184, 166, .22), transparent 35%),
                radial-gradient(circle at 90% 5%, rgba(30, 64, 175, .18), transparent 40%),
                linear-gradient(170deg, #f3f7ff 0%, #ecfdf5 50%, #f8fafc 100%);
        }
    </style>
    @stack('styles')
</head>

<body>
    @yield('content')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>

</html>
