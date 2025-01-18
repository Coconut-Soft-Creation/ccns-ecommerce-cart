<!DOCTYPE html>
<html>
<head>
    <title>@yield('title', 'Ccns-Ecommerce-Cart')</title>
</head>
<body>
<header>
    @include('ccns-ecommerce-cart::partials.header')
</header>
<main>
    @yield('content')
</main>
<footer>
    @include('ccns-ecommerce-cart::partials.footer')
</footer>
</body>
</html>
