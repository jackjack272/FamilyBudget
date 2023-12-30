<!DOCTYPE html>
<html>

<head>
    <title>@yield('title')</title>
    <link rel="icon" type="image/x-icon" href="{{asset('img/logo.jpg') }}">
    <link rel='stylesheet' href="{{asset('css/customOutSide.css')}}">
    <link rel='stylesheet' href="{{asset('css/customInside.css')}}">
    <link rel='stylesheet' href="{{asset('css/skeleton.css')}}">
    <script src='{{asset("JS/debts.js")}}'></script>
</head>

<body >
    <header>
        <div class='black_line'> &nbsp; <br>&nbsp;<br>&nbsp; </div>
        
        <div>
            <img class="logo" src="{{asset('img/logo.jpg')}}" alt="image of logo">
        </div>
        
        <div class='centerMe'>
            <h5>Know what you want and be bold in it's pursuit.</h5>
        </div>
    </header>

    @include('partials.navInside')

    <h3 class="centerMe">@yield('sub_title')</h3>

    
