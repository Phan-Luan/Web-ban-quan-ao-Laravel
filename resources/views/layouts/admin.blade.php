<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'DashBoard')</title>
    <link rel="icon" type="image/png" href="{{ asset('assets/clients/images/icons/favicon.png') }}" />
    <link href="{{ asset('assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link href="{{ asset('assets/css/sb-admin-2.css') }}" rel="stylesheet">
</head>

<body id="page-top">
    @include('flash::message')
    <div id="wrapper">
        @include('admins.blocks.sidebar')

        <div id="content-wrapper" class="d-flex flex-column">

            <div id="content">

                @include('admins.blocks.navbar-top')

                <div class="container-fluid">

                    <h1 class="h3 mb-4 text-gray-800 alert alert-primary">@yield('name-content')</h1>
                    @yield('content')
                </div>
            </div>

            @include('admins.blocks.footer')

        </div>

    </div>

    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    @include('admins.blocks.logout-modal')

</body>
@yield('script')

</html>
