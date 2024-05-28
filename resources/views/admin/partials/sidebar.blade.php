<div class="nk-sidebar">
    <div class="nk-nav-scroll">
        <ul class="metismenu" id="menu">
            {{-- <li class="nav-label">Dashboard</li> --}}
            <li>
                <a href="{{ route('admin.dashboard') }}" aria-expanded="false">
                    <i class="icon-badge menu-icon"></i><span class="nav-text">Dasboard</span>
                </a>
            </li>
            {{-- <li>
                <a href="{{ route('properties') }}" aria-expanded="false">
                    <i class="icon-badge menu-icon"></i><span class="nav-text">Properties</span>
                </a>
            </li> --}}
            <li class="mega-menu mega-menu-sm">
                <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                    <i class="icon-globe-alt menu-icon"></i><span class="nav-text">Properties</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{route('properties')}}">All Properties</a></li>
                    <li><a href="{{route('properties.create')}}">Create Property</a></li>
                </ul>
            </li>
            <li>
                <a href="{{ route('currency') }}" aria-expanded="false">
                    <i class="icon-badge menu-icon"></i><span class="nav-text">Currency</span>
                </a>
            </li>
            <li>
                <a href="{{ route('amenities') }}" aria-expanded="false">
                    <i class="icon-badge menu-icon"></i><span class="nav-text">Amenities</span>
                </a>
            </li>
            <li class="mega-menu mega-menu-sm">
                <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                    <i class="icon-globe-alt menu-icon"></i><span class="nav-text">Layouts</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="./layout-fixed-header.html">Fixed Header</a></li>
                    <li><a href="layout-fixed-sidebar.html">Fixed Sidebar</a></li>
                </ul>
            </li>


        </ul>
    </div>
</div>
