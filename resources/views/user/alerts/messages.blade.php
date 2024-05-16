<section class="containers">
    <div class="square_box box_three"></div>
    <div class="square_box box_four"></div>
    <div class="container mt-5">
        <div class="row">
            @if (session('success'))
                <div class="col-sm-12">
                    <div
                        class="alert fade alert-simple alert-success alert-dismissible text-left font__family-montserrat font__size-16 font__weight-light brk-library-rendered rendered show">
                        <button type="button" class="close font__size-18" data-dismiss="alert">
                            <span aria-hidden="true"><a>
                                    <i class="fa fa-times greencross"></i>
                                </a></span>
                            <span class="sr-only">Close</span>
                        </button>
                        <i class="start-icon far fa-check-circle faa-tada animated"></i>
                        <strong class="font__weight-semibold"></strong>{{ session('success') }}
                    </div>
                </div>
            @endif
            @if (session('error'))
                <div class="col-sm-12">
                    <div class="alert fade alert-simple alert-info alert-dismissible text-left font__family-montserrat font__size-16 font__weight-light brk-library-rendered rendered show"
                        role="alert" data-brk-library="component__alert">
                        <button type="button" class="close font__size-18" data-dismiss="alert">
                            <span aria-hidden="true">
                                <i class="fa fa-times blue-cross"></i>
                            </span>
                            <span class="sr-only">Close</span>
                        </button>
                        <i class="start-icon  fa fa-info-circle faa-shake animated"></i>
                        <strong class="font__weight-semibold">Oops!</strong> {{ session('error') }}
                    </div>

                </div>
            @endif
            @if (session('warning'))
                <div class="col-sm-12">
                    <div class="alert fade alert-simple alert-warning alert-dismissible text-left font__family-montserrat font__size-16 font__weight-light brk-library-rendered rendered show"
                        role="alert" data-brk-library="component__alert">
                        <button type="button" class="close font__size-18" data-dismiss="alert">
                            <span aria-hidden="true">
                                <i class="fa fa-times warning"></i>
                            </span>
                            <span class="sr-only">Close</span>
                        </button>
                        <i class="start-icon fa fa-exclamation-triangle faa-flash animated"></i>
                        <strong class="font__weight-semibold">Warning!</strong> {{ session('warning') }}
                    </div>
            @endif
            @if (session('info'))
                <div class="col-sm-12">
                    <div class="alert fade alert-simple alert-danger alert-dismissible text-left font__family-montserrat font__size-16 font__weight-light brk-library-rendered rendered show"
                        role="alert" data-brk-library="component__alert">
                        <button type="button" class="close font__size-18" data-dismiss="alert">
                            <span aria-hidden="true">
                                <i class="fa fa-times danger "></i>
                            </span>
                            <span class="sr-only">Close</span>
                        </button>
                        <i class="start-icon far fa-times-circle faa-pulse animated"></i>
                        <strong class="font__weight-semibold">{{ session('info') }}</strong>
                    </div>
                </div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li><strong>Error:</strong> {{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            {{-- 
            <div class="col-sm-12">
                <div class="alert fade alert-simple alert-primary alert-dismissible text-left font__family-montserrat font__size-16 font__weight-light brk-library-rendered rendered show"
                    role="alert" data-brk-library="component__alert">
                    <button type="button" class="close font__size-18" data-dismiss="alert">
                        <span aria-hidden="true"><i class="fa fa-times alertprimary"></i></span>
                        <span class="sr-only">Close</span>
                    </button>
                    <i class="start-icon fa fa-thumbs-up faa-bounce animated"></i>
                    <strong class="font__weight-semibold">Well done!</strong> You successfully read this important.
                </div>

            </div> --}}

        </div>
    </div>
</section>
