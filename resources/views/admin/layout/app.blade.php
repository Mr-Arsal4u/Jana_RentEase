<!DOCTYPE html>
<html lang="en">

@include('admin.partials.head')

<body>

    @include('admin.partials.loader')

    <div id="main-wrapper">

        @include('admin.partials.navbar')


        @include('admin.partials.sidebar')

        <div class="content-body">

            @yield('content')

        </div>

        @include('admin.partials.footer')

    </div>

    @include('admin.partials.scripts')

</body>

</html>
