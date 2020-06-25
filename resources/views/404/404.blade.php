<!DOCTYPE html>
<html >
<head>
    <meta charset="UTF-8">
    <title>404 Not Found Page - E-SHOP</title>
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta name="description" content="The E-SHOP Store 404 not found page">
    <meta name="keywords" content="404, not found, error, e-commerce">
    <link href="//fonts.googleapis.com/css?family=Playfair+Display|Baloo+Bhaijaan|Raleway:100,400,700" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('404/css/normalize.min.css') }}">
    <link rel="stylesheet" href="{{ asset('404/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('404/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('404/css/reveal.css') }}">
</head>
<body>
<div id="triangles"></div>
<header>
    <a href="{{ route('site_url') }}">
        <img class="logo" src="{{ asset('404/images/logo.png') }}" />
        <h3 style="color: #FFFFFF;">E-SHOP STORE</h3>
    </a>
</header>

<div class="content">
    <h1>404</h1>
    <h2>The page you are looking for doesn't exist.</h2>
    <a class="btn" href="{{ route('site_url') }}">
        Go back to our Homepage
    </a>
</div>

<script src="{{ asset('404/js/prefixfree.min.js') }}"></script>
<script src='{{ asset('404/js/three.min.js') }}'></script>
<script src='{{ asset('404/js/ThreeCSG.js') }}'></script>
<script src='{{ asset('404/js/OrbitControls.js') }}'></script>
<script src='{{ asset('404/js/Tween.js') }}'></script>
<script src="{{ asset('404/js/jquery.min.js') }}"></script>
<script src="{{ asset('404/js/anime.min.js') }}"></script>
<script src="{{ asset('404/js/reveal.js') }}"></script>
<script src="{{ asset('404/js/index.js') }}"></script>
</body>

</html>
