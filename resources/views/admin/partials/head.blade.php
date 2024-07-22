<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    {{-- <meta>
     --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- theme meta -->
    <meta name="theme-name" content="quixlab" />

    <title>JANA - RentEase</title>
    <!-- Favicon icon -->
    <!-- Favicon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('admin/images/favicon.png') }}">
    {{-- <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet"> --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- CSS Plugins -->
    <link href="{{ asset('admin/plugins/pg-calendar/css/pignose.calendar.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('admin/plugins/chartist/css/chartist.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/plugins/chartist-plugin-tooltips/css/chartist-plugin-tooltip.css') }}">

    <!-- Custom Stylesheet -->
    <link href="{{ asset('admin/plugins/jquery-steps/css/jquery.steps.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/css/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <style>
        :root {
    --primary-color: rgb(11, 78, 179);
}

*,
*::before,
*::after {
    box-sizing: border-box;
}

html, body {
    height: 100%;
    margin: 0;
}

.main {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    background-color: #f3f3f3;
    position: relative;
}

label {
    display: block;
    margin-bottom: 0.5rem;
}

.width-50 {
    width: 50%;
}

.ml-auto {
    margin-left: auto;
}

.text-center {
    text-align: center;
}

.progressbar {
    position: relative;
    display: flex;
    justify-content: space-between;
    counter-reset: step;
    margin: 2rem 0 4rem;
}

.progressbar::before,
.progress {
    content: "";
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    height: 4px;
    width: 100%;
    background-color: #dcdcdc;
    z-index: 1;
}

.progress {
    background-color: rgb(0 128 0);
    width: 0%;
    transition: 0.3s;
}

.progress-step {
    width: 2.1875rem;
    height: 2.1875rem;
    background-color: #dcdcdc;
    border-radius: 50%;
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 1;
}

.progress-step::before {
    counter-increment: step;
    content: counter(step);
}

.progress-step::after {
    content: attr(data-title);
    position: absolute;
    top: calc(100% + 0.5rem);
    font-size: 0.85rem;
    color: #666;
}

.progress-step-active {
    background-color: var(--primary-color);
    color: #f3f3f3;
}

.form {
    /* margin-top: 20rem; */
    width: 800px;
    border: none;
    border-radius: 10px !important;
    overflow: hidden;
    padding: 1.5rem;
    background-color: #fff;
    padding: 20px 30px;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
}

.step-forms {
    display: none;
    transform-origin: top;
    animation: animate 1s;
}

.step-forms-active {
    display: block;
}

.group-inputs {
    margin: 1rem 0;
}

@keyframes animate {
    from {
        transform: scale(1, 0);
        opacity: 0;
    }

    to {
        transform: scale(1, 1);
        opacity: 1;
    }
}

.btns-group {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 1.5rem;
}

.btn {
    padding: 0.75rem;
    display: block;
    text-decoration: none;
    background-color: var(--primary-color);
    color: #f3f3f3;
    text-align: center;
    border-radius: 0.25rem;
    cursor: pointer;
    transition: 0.3s;
}

.btn:hover {
    box-shadow: 0 0 0 2px #fff, 0 0 0 3px var(--primary-color);
}

.progress-step-check {
    position: relative;
    background-color: green !important;
    transition: all 0.8s;
}

.progress-step-check::before {
    position: absolute;
    content: '\2713';
    width: 100%;
    height: 100%;
    top: 8px;
    left: 13px;
    font-size: 12px;
}

.group-inputs {
    position: relative;
}

.group-inputs label {
    font-size: 13px;
    position: absolute;
    height: 19px;
    padding: 4px 7px;
    top: -14px;
    left: 10px;
    color: #a2a2a2;
    background-color: white;
}

.welcome {
    height: 450px;
    width: 350px;
    background-color: #fff;
    border-radius: 6px;
    display: flex;
    justify-content: center;
    align-items: center;
}

.welcome .content {
    display: flex;
    align-items: center;
    flex-direction: column;
}

.checkmark__circle {
    stroke-dasharray: 166;
    stroke-dashoffset: 166;
    stroke-width: 2;
    stroke-miterlimit: 10;
    stroke: #7ac142;
    fill: none;
    animation: stroke 0.6s cubic-bezier(0.65, 0, 0.45, 1) forwards;
}

.checkmark {
    width: 56px;
    height: 56px;
    border-radius: 50%;
    display: block;
    stroke-width: 2;
    stroke: #fff;
    stroke-miterlimit: 10;
    margin: 10% auto;
    box-shadow: inset 0px 0px 0px #7ac142;
    animation: fill .4s ease-in-out .4s forwards, scale .3s ease-in-out .9s both;
}

.checkmark__check {
    transform-origin: 50% 50%;
    stroke-dasharray: 48;
    stroke-dashoffset: 48;
    animation: stroke 0.3s cubic-bezier(0.65, 0, 0.45, 1) 0.8s forwards;
}

@keyframes stroke {
    100% {
        stroke-dashoffset: 0;
    }
}

@keyframes scale {
    0%,
    100% {
        transform: none;
    }

    50% {
        transform: scale3d(1.1, 1.1, 1);
    }
}

@keyframes fill {
    100% {
        box-shadow: inset 0px 0px 0px 30px #7ac142;
    }
}

    </style>
    
    <style>
        .currency-options.currency {
            display: inline-block;
            margin-right: 10px;
        }

        @media (max-width: 768px) {
            .currency-options.currency {
                display: block;
                margin-bottom: 10px;
            }
        }
    </style>
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
            margin-top: 50px;
            max-width: 900px;
            box-shadow: 20px 20px 12px rgba(0, 0, 0, 0.2);
            background-color: rgb(221 222 223);

        }

        .step-header {
            background-color: rgb(54, 88, 130);
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            text-align: center;
            margin: 5px;
        }
    </style>
    <style>
        .room-container {
            display: none;
            /* Initially hidden */
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #ffffff;
            /* White background */
            padding: 40px;
            /* Increased padding */
            border: 1px solid #ccc;
            border-radius: 15px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            z-index: 9999;
            width: 420px;
            /* Increased width */
            transition: opacity 0.3s, transform 0.3s;
            /* Smooth transition animation */
        }

        .room-box {
            padding: 20px;
            margin-bottom: 10px;
            border: 1px solid #007bff;
            border-radius: 15px;
            background-color: #f0f8ff;
            cursor: pointer;
            text-align: center;
            transition: background-color 0.3s, transform 0.3s;
            /* Smooth box transform and background color change */
        }

        .room-box:hover {
            background-color: #e7f3ff;
            transform: scale(1.05);
            /* Scale up on hover */
        }
    </style>

</head>
