<!DOCTYPE html>
<html lang="{{config('app.locale')}}">

<head>

    <meta charset="UTF-8">
    <title>@yield('title',config('app.name'))</title>
    @include('sablonlar.resources.views.views.sablonlar.kalıpkodlar.SiteÖzellikleri')
    @yield('head')

</head>

<body id="commerce">
@include('sablonlar.resources.views.views.sablonlar.kalıpkodlar.menu')
@yield('content')
@include('sablonlar.resources.views.views.sablonlar.kalıpkodlar.yapımcı')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

@yield('footer')
</body>

</html>
