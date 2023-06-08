@extends('base')

    <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Dashboard - NiceAdmin Bootstrap Template</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css" integrity="sha256-mmgLkCYLUQbXn0B1SRqzHar6dCnv9oZFPEC1g1cwlkk=" crossorigin="anonymous" />

    <!-- Favicons -->
    <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/quill/quill.snow.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/quill/quill.bubble.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/simple-datatables/style.css') }}" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">

</head>

<body>

<!-- ======= Header ======= -->
<header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex p-2 justify-content-between" >
        <a href="" class="logo d-flex align-items-center">
            <i class="fas fa-book-open fa-2xl"></i>
            <span style="padding-left: 10px" class="d-none d-lg-block">BookStore</span>
        </a>
        <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    <div class="search-bar">
        <form class="search-form d-flex align-items-center" method="POST" action="#">
            <input type="text" name="query" placeholder="Search" title="Enter search keyword">
            <button type="submit" title="Search"><i class="bi bi-search"></i></button>
        </form>
    </div><!-- End Search Bar -->

    <nav class="header-nav ms-auto">
        <ul class="d-flex align-items-center">

            <li class="nav-item d-block d-lg-none">
                <a class="nav-link nav-icon search-bar-toggle " href="#">
                    <i class="bi bi-search"></i>
                </a>
            </li><!-- End Search Icon-->

            <li class="nav-item dropdown pe-3">
                <a href="{{ route('login') }}" class="btn btn-sm btn-primary">
                    <i class="fas fa-sign-in-alt"></i>
                    Login</a>
            </li>
        </ul>
    </nav><!-- End Icons Navigation -->

</header><!-- End Header -->

<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">


        <li class="nav-item">
            <a class="nav-link " href="{{ route('dash_pub') }}">
                <i class="bi bi-book-half"></i>
                <span>Livres</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link " href="{{ route('posts_pub') }}">
                <i class="fa-brands fa-blogger"></i>
                <span>Blog</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link " href="{{ route('login') }}" >
                <i class="fas fa-sign-in-alt"></i>
                <span>Login</span>
            </a>
        </li>

    </ul>

</aside><!-- End Sidebar-->


<main id="main" class="main">
    <div class="pagetitle">
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Dashbord</a></li>
                <li class="breadcrumb-item active">Livres</li>
            </ol>
        </nav>
    </div>
    <section class="livre-detail">
        <div class="row">
            <div class="col-md-5">
                <div class="project-info-box mt-0">
                    <h1 style="font-size: 25px">{{ $book->titre }}</h1>
                    <p class="mb-0">{{ $book->description }}</p>
                </div><!-- / project-info-box -->

                <div class="project-info-box">
                    <p><b>Autheur:</b> {{$book->autheur}}</p>
                    <p><b>Categorie:</b> {{$book->categorie}}</p>
                    <p><b>Date:</b> {{$book->annee}}</p>
                    <p><b>Launge:</b> {{$book->launge}}</p>
                    <p><b>Status:</b>@if($book->dispo == 0)<span style="color: red"> Not Disponible</span>
                        @else
                            <span style="color: green"> Disponible</span>
                        @endif</p>
                    @if($book->dispo == 0)
                        <p><b>Date de retour : @isset($empr->date_fin)
                                    {{\Carbon\Carbon::parse($empr->date_fin)->format('Y-m-d')}}
                                @endisset
                            </b> </p>
                    @else
                        <a  href="{{ route('login') }}" class="btn btn-success">Emprunter ce livre</a>
                    @endif
                </div><!-- / project-info-box -->

                <!-- / project-info-box -->
            </div><!-- / column -->

            <div class="col-md-7">
                <img src="{{asset('./images_livres/'.$book->image)}}" alt="project-image" class="rounded">
            </div><!-- / column -->
        </div>
    </section>
</main>


<!-- ======= Footer ======= -->
<footer id="footer" class="footer">
    <div class="copyright">
        &copy; Copyright <strong><span>NiceAdmin</span></strong>. All Rights Reserved
    </div>
    <div class="credits">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
        Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
    </div>
</footer><!-- End Footer -->

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
<!-- Vendor JS Files -->
<script src="{{ asset('assets/vendor/apexcharts/apexcharts.min.js') }}"></script>
<script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/vendor/chart.js/chart.umd.js') }}"></script>
<script src="{{ asset('assets/vendor/echarts/echarts.min.js') }}"></script>
<script src="{{ asset('assets/vendor/quill/quill.min.js') }}"></script>
<script src="{{ asset('assets/vendor/simple-datatables/simple-datatables.js') }}"></script>
<script src="{{ asset('assets/vendor/tinymce/tinymce.min.js') }}" ></script>
<script src="{{ asset('assets/vendor/php-email-form/validate.js') }}"></script>

<!-- Template Main JS File -->
<script src="{{ asset('assets/js/main.js') }}"></script>

</body>

</html>
