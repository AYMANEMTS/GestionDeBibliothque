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
        <h1>Dashbord</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item active">Livres</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section profile">
        <div class="row">
            @foreach($posts as $post)
                <div class="col-4">
                    <div class="card" style="width: 250px;height: 400px">
                        @if($post->image)
                            <img class="card-img" style="margin: 0px;height: 200px" src="{{ asset('./images_posts/'.$post->image) }}" alt="Bologna">
                        @else
                            <img class="card-img" style="margin: 0px;height: 200px" src="https://s3.eu-central-1.amazonaws.com/bootstrapbaymisc/blog/24_days_bootstrap/pasta.jpg" alt="Bologna">
                        @endif
                        <div class="card-body">
                            <h4 class="card-title"  style="padding-top: 0px">Pasta with Prosciutto</h4>
                            <p class="text-primary cat">
                                @if($post->users->profile_img)
                                    <img class="img-circle" style="height: 30px;width: 30px;margin: 0px" src="{{ asset('./images_profiles/'.$post->users->profile_img) }}" alt="">
                                @else
                                    <img class="img-circle" style="height: 30px;width: 30px;margin: 0px" src="https://s3.eu-central-1.amazonaws.com/bootstrapbaymisc/blog/24_days_bootstrap/pasta.jpg" alt="">
                                @endif
                                @<span>{{ $post->users->username }}</span>
                            </p>
                            <a href="{{ route('post_show_pub',$post->id) }}" class="btn btn-info">Read more</a>
                        </div>
                        <div class="card-footer text-muted d-flex justify-content-between bg-transparent border-top-0">
                            <div class="views">{{Carbon\Carbon::parse($post->created_at)->format('M d, h:iA')}}
                            </div>
                            <div class="stats">
                                <i class="far fa-eye"></i> 1347
                                <i class="far fa-comment"></i> 12
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        {{ $posts->links() }}
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
