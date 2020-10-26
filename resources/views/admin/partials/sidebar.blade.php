<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('index') }}">
        <div class="sidebar-brand-text mx-3">
            <img style="height: 30px" class="mr-1" src="{{ asset('storage/images/favicon-96x96.png') }}" alt="">
            {{ config('app.name') }}
        </div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('admin.index') }}">
            <span>Tableau de bord</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Contenus
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.faq.index') }}">
            <ion-icon class="mb-0 align-text-bottom mr-2" name="chatbox-outline"></ion-icon>
            <span>FAQ</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.user.index') }}">
            <ion-icon class="mb-0 align-text-bottom mr-2" name="people-outline"></ion-icon>
            <span>Utilisateurs</span>
        </a>
    </li>

    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Actions
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.reports') }}">
            <ion-icon class="mb-0 align-text-bottom mr-2" name="shield-outline"></ion-icon>
            <span>Signalement</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle">
        </button>
    </div>

</ul>
<!-- End of Sidebar -->
