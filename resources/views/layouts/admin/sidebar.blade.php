
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
            <li class="menu-header">Log</li>
            <li class="@if (request()->routeIs('logs.details.index')) active @endif"><a class="nav-link" href="{{ route('logs.details.index') }}"><i class="fas fa-fish"></i> <span>Aquarium</span></a></li>
            <li class="@if (request()->routeIs('logs.drains.index')) active @endif"><a class="nav-link" href="{{ route('logs.drains.index') }}"><i class="fas fa-tint"></i> <span>Pengurasan</span></a></li>
        </ul>
    </aside>
</div>
