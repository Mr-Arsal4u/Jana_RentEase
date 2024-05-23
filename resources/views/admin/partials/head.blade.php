<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
{{-- <meta>
     --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- theme meta -->
    <meta name="theme-name" content="quixlab" />

    <title>Quixlab - Bootstrap Admin Dashboard Template by Themefisher.com</title>
    <!-- Favicon icon -->
    <!-- Favicon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('admin/images/favicon.png') }}">

    <!-- CSS Plugins -->
    <link href="{{ asset('admin/plugins/pg-calendar/css/pignose.calendar.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('admin/plugins/chartist/css/chartist.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/plugins/chartist-plugin-tooltips/css/chartist-plugin-tooltip.css') }}">

    <!-- Custom Stylesheet -->
    <link href="{{asset('admin/plugins/jquery-steps/css/jquery.steps.css')}}" rel="stylesheet">
    <link href="{{ asset('admin/css/style.css') }}" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .step {
            display: none;
        }

        .step.active {
            display: block;
        }

        .step-header {
            cursor: pointer;
        }

        .step-header.active {
            font-weight: bold;
            color: #007bff;
        }

        .container-custom {
            max-width: 900px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        }
    </style>

    
</head>