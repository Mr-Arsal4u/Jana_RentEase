<!DOCTYPE html>
<html lang="en">

@include('user.partials.head')

<body>
  @if (session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
  
@endif
    @include('user.partials.navbar')

    @yield('content')



    @include('user.partials.footer')
    <!-- loader -->
    @include('user.partials.loader')

    @include('user.partials.scripts')


</body>

</html>
