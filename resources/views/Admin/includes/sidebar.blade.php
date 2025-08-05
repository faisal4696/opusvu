<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('dashboard') }}">
        <div class="sidebar-brand-icon">
            <img src="{{ asset('img/logo.png') }}" alt="logo" style="border-radius: 50px; height: 40px; width: 40px;">
        </div>
        <div class="sidebar-brand-text mx-3">opusvu</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Interface
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item view-categories">
        <a class="nav-link collapsed" href="{{ route('view-categories') }}"><i class="fas fa-list-alt"></i> <span> View Categories</span></a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ route('view-categories') }}">View Categories</a>
                <a class="collapse-item" href="{{ route('add-category') }}">Add New</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item view-users">
        <a class="nav-link collapsed" href="{{ route('view-users') }}"><i class="fas fa-fw fa-user"></i> <span> View Users</span></a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
             data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ route('view-users') }}">View Users</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item view-videos">
        <a class="nav-link collapsed" href="{{ route('view-videos') }}"><i class="fas fa-fw fa-video"></i> <span> View Videos</span></a>
        <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ route('view-videos') }}">View Videos</a>
                <a class="collapse-item" href="{{ route('add-video') }}">Add New</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item promotion">
        <a class="nav-link collapsed" href="{{ route('video-promotion') }}"><i class="fas fa-fw fa-bullhorn"></i> <span> Video Promotion</span></a>
        <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ route('view-videos') }}">View Videos</a>
                <a class="collapse-item" href="{{ route('add-video') }}">Add New</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item advertisement ">
        <a class="nav-link collapsed" href="{{ route('view-advertisements') }}"><i class="fas fa-fw fa-ad"></i> <span> Advertisements </span></a>
        <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
{{--            <div class="bg-white py-2 collapse-inner rounded">--}}
{{--                <a class="collapse-item" href="{{ route('view-videos') }}">View Videos</a>--}}
{{--                <a class="collapse-item" href="{{ route('add-video') }}">Add New</a>--}}
{{--            </div>--}}
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>
<!-- End of Sidebar -->
