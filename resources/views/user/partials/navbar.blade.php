<div class="wrap">
    <div class="container">
        <div class="row justify-content-between">
            <div class="col d-flex align-items-center">
                <p class="mb-0 phone"><span class="mailus">Phone no:</span> <a href="#">+00 1234 567</a> or <span
                        class="mailus">email us:</span> <a href="#">emailsample@email.com</a></p>
            </div>
            <div class="col d-flex justify-content-end">
                <div class="social-media">
                    <p class="mb-0 d-flex">
                        <a href="#" class="d-flex align-items-center justify-content-center"><span
                                class="fa fa-facebook"><i class="sr-only">Facebook</i></span></a>
                        <a href="#" class="d-flex align-items-center justify-content-center"><span
                                class="fa fa-twitter"><i class="sr-only">Twitter</i></span></a>
                        <a href="#" class="d-flex align-items-center justify-content-center"><span
                                class="fa fa-instagram"><i class="sr-only">Instagram</i></span></a>
                          <a href="#" class="d-flex align-items-center justify-content-center"><span
                                class="fa fa-dribbble"><i class="sr-only">Dribbble</i></span></a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
    <div class="container">
        <a class="navbar-brand" href="{{ route('index') }}">Jana<span>-Rental Ease</span></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav"
            aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="fa fa-bars"></span> Menu
        </button>
        <div class="collapse navbar-collapse" id="ftco-nav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item{{ request()->routeIs('index') ? ' active' : '' }}">
                    <a href="{{ route('index') }}" class="nav-link">Home</a>
                </li>
                <li class="nav-item{{ request()->routeIs('about-us') ? ' active' : '' }}">
                    <a href="{{ route('about-us') }}" class="nav-link">About</a>
                </li>
                <li class="nav-item{{ request()->routeIs('services') ? ' active' : '' }}">
                    <a href="{{ route('services') }}" class="nav-link">Services</a>
                </li>
                {{-- <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle {{ request()->is('property-listings/*') ? ' active' : '' }}"
                        href="#" id="propertiesDropdown" role="button" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        Properties
                    </a>

                    <div class="dropdown-menu" aria-labelledby="propertiesDropdown">
                        <a class="dropdown-item {{ request()->is('property-listings/apartment') ? 'active' : '' }}"
                            href="{{ route('rooms', 'apartment') }}">Apartment Rooms</a>
                        <a class="dropdown-item {{ request()->is('property-listings/house') ? 'active' : '' }}"
                            href="{{ route('rooms', 'house') }}">Houses</a>
                    </div>
                </li> --}}
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle {{ request()->is('property-listings/*') ? ' active' : '' }}"
                        href="#" id="propertiesDropdown" role="button" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                            Properties
                    </a>    

                    <div class="dropdown-menu" aria-labelledby="propertiesDropdown">
                        <a class="dropdown-item {{ request()->is('property-listings/apartment') ? 'active' : '' }}"
                            href="{{ route('rooms', 'apartment') }}">Apartment Rooms</a>
                        <a class="dropdown-item {{ request()->is('property-listings/house') ? 'active' : '' }}"
                            href="{{ route('rooms', 'house') }}">Houses</a>
                    </div>
                </li>
                <li class="nav-item{{ request()->routeIs('blog') ? ' active' : '' }}">
                    <a href="{{ route('blog') }}" class="nav-link">Blog</a>
                </li>
                <li class="nav-item{{ request()->routeIs('contact-us') ? ' active' : '' }}">
                    <a href="{{ route('contact-us') }}" class="nav-link">Contact</a>
                </li>
            </ul>

        </div>
    </div>
</nav>
