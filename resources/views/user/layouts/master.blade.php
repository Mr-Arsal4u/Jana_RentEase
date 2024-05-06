<!DOCTYPE html>
<html lang="en">

@include('user.partials.head')

<body>
  @include('user.partials.navbar')

    @yield('content')

    @include('user.partials.footer')
    <!-- loader -->
    @include('user.partials.loader')

    @include('user.partials.scripts')


</body>

</html>
