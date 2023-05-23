<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <!-- Brand and toggle get grouped for better mobile display -->
    <a style="margin-left: 0px" class="navbar-brand"  href="{{ route('moder.dashbord') }}">
        Dashbord Moderateur
    </a>
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>

    </div>
    <!-- Top Menu Items -->
    <ul class="nav navbar-right top-nav">
        <li><a href="{{ route('moder.dashbord') }}"><i class="fa-sharp fa-solid fa-house"></i> Home</a></li>
        <li><a href="{{ route('moder.profile') }}"><i class="fa fa-fw fa-user"></i> Profile</a></li>
        <li><a href="{{ route('logout') }}"><i class="fa-sharp fa-solid fa-right-from-bracket"></i> Logout</a></li>

    </ul>
    <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
    <div class="collapse navbar-collapse navbar-ex1-collapse">
        <ul class="nav navbar-nav side-nav">
            <li>
                <a href="{{ route('moder.dashbord') }}"><i class="fa-sharp fa-solid fa-table-columns"></i>  Dashbord</a>
            </li>
            <li>
                <a href="{{ route('moder.etudiant') }}"><i class="fa-sharp fa-solid fa-users"></i> Etudiant</a>
            </li>
            <li>
                <a href="{{ route('moder.livre') }}"><i class="fa-sharp fa-solid fa-book"></i>     Livre</a>
            </li>
            <li>
                <a href="{{ route('moder.profile') }}"><i class="fa fa-fw fa-user"></i> Profile</a>
            </li>
        </ul>
    </div>
    <!-- /.navbar-collapse -->
</nav>
