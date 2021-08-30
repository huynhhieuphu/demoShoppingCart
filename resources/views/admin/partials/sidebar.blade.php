<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">SB Admin <sup>2</sup></div>
    </a>
    <!-- Divider -->
    <hr class="sidebar-divider my-0">


@foreach(config('menu') as $menu)
    @if(array_key_exists('sub-menu', $menu))
        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="" data-toggle="collapse" data-target="#collapse{{$menu['name']}}"
               aria-expanded="true" aria-controls="collapse{{$menu['name']}}">
                <i class="{{$menu['font']}}"></i>
                <span>{{$menu['name']}}</span>
            </a>
            <div id="collapse{{$menu['name']}}" class="collapse" aria-labelledby="heading{{$menu['name']}}"
                 data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    @foreach($menu['sub-menu'] as $sub)
                        <a class="collapse-item" href="{{route($sub['href'])}}">{{$sub['name']}}</a>
                    @endforeach
                </div>
            </div>
        </li>
    @else
        <!-- Nav Item - Dashboard -->
        <li class="nav-item active">
            <a class="nav-link" href="{{route($menu['href'])}}">
                <i class="{{$menu['font']}}"></i>
                <span>{{$menu['name']}}</span></a>
        </li>
    @endif
    <!-- Divider -->
    <hr class="sidebar-divider">
@endforeach

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>

