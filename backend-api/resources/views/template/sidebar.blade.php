<!-- Sidebar -->
<?php
use Illuminate\Support\Facades\Request;
$urlSegment = Request::segments();
?>

<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{url('/dashboard')}}">
    <div class="sidebar-brand-icon rotate-n-15">
        <i class="fas fa-laugh-wink"></i>
    </div>
    <div class="sidebar-brand-text mx-3">DT Ihsaniyya</div>
</a>

<!-- Divider -->
<hr class="sidebar-divider my-0">

<!-- Nav Item - Dashboard -->
<li class="nav-item {{end($urlSegment) == 'dashboard' ? 'active' : ''}}">
    <a class="nav-link }" href="{{url('/dashboard')}}">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span>
    </a>
</li>

<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">
    Data
</div>

<li class="nav-item {{end($urlSegment) == 'donasi' ? 'active' : ''}}">
    <a class="nav-link collapsed" href="{{url('/dashboard/donasi')}}">
        <i class="fas fa-fw fa-money-check-alt"></i>
        <span>Donasi</span>
    </a>
</li>

<li class="nav-item {{end($urlSegment) == 'campaign' ? 'active' : ''}}">
    <a class="nav-link collapsed" href="{{ url('/dashboard/campaign') }}">
        <i class="fas fa-campground"></i>
        <span>Campaign</span>
    </a>
</li>

<li class="nav-item {{end($urlSegment) == 'banner' ? 'active' : ''}}">
    <a class="nav-link collapsed" href="{{ url('/dashboard/banner') }}">
        <i class="far fa-images"></i>
        <span>Banner</span>
    </a>
</li>

<li class="nav-item {{end($urlSegment) == 'user' ? 'active' : ''}}">
    <a class="nav-link collapsed" href="{{ url('/dashboard/user') }}">
        <i class="far fa-user"></i>
        <span>User</span>
    </a>
</li>

<hr class="sidebar-divider">

<!-- Sidebar Toggler (Sidebar) -->
<div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>

<!-- End of Sidebar -->