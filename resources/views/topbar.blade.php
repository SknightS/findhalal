<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="#">
    <title>Find Halal</title>
    <!-- Bootstrap core CSS -->
    <link href="{{url('css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{url('css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{url('css/animsition.min.css')}}" rel="stylesheet">
    <link href="{{url('css/animate.css')}}" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="{{url('css/style.css')}}" rel="stylesheet"> </head>
<!--[if lt IE 9]-->
<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.css">

@yield('header')
<body class="home">
<div class="site-wrapper animsition" data-animsition-in="fade-in" data-animsition-out="fade-out">
    <!--header starts-->
    <header id="header" class="header-scroll top-header headrom">
        <!-- .navbar -->
        <nav class="navbar navbar-dark">
            <div class="container">
                <button class="navbar-toggler hidden-lg-up" type="button" data-toggle="collapse" data-target="#mainNavbarCollapse">&#9776;</button>
                <a class="navbar-brand" href="{{route('home')}}"> <img class="img-rounded" src="{{url('images/food-picky-logo.png')}}" alt=""> </a>
                <div class="collapse navbar-toggleable-md  float-lg-right" id="mainNavbarCollapse">
                    <ul class="nav navbar-nav">
                        <li class="nav-item"> <a class="nav-link active" href="{{route('home')}}">Home <span class="sr-only">(current)</span></a> </li>

                        <li class="nav-item"> <a class="nav-link active" href="{{route('contact')}}">Contact <span class="sr-only"></span></a> </li>


                    </ul>
                </div>
            </div>
        </nav>
        <!-- /.navbar -->
    </header>
</div>

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-117514017-1"></script>
<script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'UA-117514017-1');
</script>