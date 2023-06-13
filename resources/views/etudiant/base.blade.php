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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">

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

                <a class="nav-link nav-profile d-flex align-items-center pe-0" href="{{ route('profile',['id' => Auth::user()->id]) }}" data-bs-toggle="dropdown">
                    <img src="{{ asset('./images_profiles/'. \Illuminate\Support\Facades\Auth::user()->profile_img) }}" alt="Profile" class="rounded-circle">

                    <span  class="d-none d-md-block dropdown-toggle ps-2">{{ Auth::user()->username }}</span>
                </a><!-- End Profile Iamge Icon -->
            </li><!-- End Profile Nav -->
            <li class="nav-item dropdown">

                <a class="nav-link nav-icon" href="{{ route('messages') }}" >
                    <i class="bi bi-bell"></i>
                    <span class="badge bg-primary badge-number">{{ \App\Models\Msage::where('utilisateure_id',\Illuminate\Support\Facades\Auth::user()->id)->count() }}</span>
                </a><!-- End Notification Icon -->
            </li>
        </ul>
    </nav><!-- End Icons Navigation -->

</header><!-- End Header -->

<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link " href="{{ route('Mydashbord') }}">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li><!-- End Dashboard Nav -->
        <li class="nav-item">
            <a class="nav-link " href="{{ route('profile',['id' => Auth::id()]) }}">
                <i class="bi bi-person"></i>
                <span>Profile</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link " href="{{ route('Post.index') }}">
                <i class="fa-brands fa-blogger"></i>
                <span>Blog</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link " href="{{ route('books') }}">
                <i class="bi bi-book-half"></i>
                <span>Livres</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link " href="{{ route('mes_emprunts') }}">
                <i class="fas fa fa-table"></i>
                <span>Mes emprunts</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link " href="{{ route('logout') }}">
                <i class="bi bi-arrow-left-circle"></i>
                <span>Logout</span>
            </a>
        </li>
    </ul>

</aside>




<main>

@yield('main')






</main>


<footer id="footer" class="footer">
    <div class="copyright">
        &copy; Copyright <strong><span>NiceAdmin</span></strong>. All Rights Reserved
    </div>
</footer>

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="{{ asset('assets/vendor/apexcharts/apexcharts.min.js') }}"></script>
<script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/vendor/chart.js/chart.umd.js') }}"></script>
<script src="{{ asset('assets/vendor/echarts/echarts.min.js') }}"></script>
<script src="{{ asset('assets/vendor/quill/quill.min.js') }}"></script>
<script src="{{ asset('assets/vendor/simple-datatables/simple-datatables.js') }}"></script>
<script src="{{ asset('assets/vendor/tinymce/tinymce.min.js') }}"></script>
<script src="{{ asset('assets/vendor/php-email-form/validate.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.min.js"></script>


<script src="{{ asset('assets/js/main.js') }}"></script>

</body>

</html>
