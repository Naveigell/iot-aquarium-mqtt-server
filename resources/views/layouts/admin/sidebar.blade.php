
<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ route('dashboard.index') }}">IOT Aquarium</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ route('dashboard.index') }}">Aqua</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Menu</li>
            <li class="@if (request()->routeIs('dashboard.index')) active @endif"><a class="nav-link" href="{{ route('dashboard.index') }}"><i class="fas fa-home"></i> <span>Dashboard</span></a></li>
        </ul>
    </aside>
</div>
