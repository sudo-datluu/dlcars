<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DL Cars Rental</title>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <!-- Google Fonts Roboto -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" />
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <!-- MDB -->
    <link rel="stylesheet" href="{{asset('css/mdb.min.css')}}" />

    <link rel="stylesheet" href="{{asset('css/custom.css')}}" />
</head>

<body>
    <main>
        <header>
            <nav class="navbar navbar-expand-lg navbar-light bg-body-tertiary">
                <!-- Container wrapper -->
                <div class="container-fluid">

                    <!-- Collapsible wrapper -->
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <!-- Navbar brand -->
                        <a class="navbar-brand mt-2 mt-lg-0" href="#">
                            <img src="{{ asset('img/logo.png') }}" height="40" alt="MDB Logo" loading="lazy" />
                            <h2 class="text-primary m-0">DLCars</h2>
                        </a>
                        @yield('nav-categories')
                    </div>
                    <!-- Collapsible wrapper -->

                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" href="#">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Team</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Projects</a>
                        </li>
                    </ul>
                </div>
                <!-- Container wrapper -->
            </nav>
        </header>
        <div class="container">
            <div class="d-flex justify-content-center align-items-center" style="height: 100vh">
                <div class="text-center">
                    <img class="mb-4" src="https://mdbootstrap.com/img/logo/mdb-transparent-250px.png" style="width: 250px; height: 90px" />
                    <h5 class="mb-3">Thank you for using our product. We're glad you're with us.</h5>
                    <p class="mb-3">MDB Team</p>
                    <a class="btn btn-primary btn-lg" data-mdb-ripple-init href="https://mdbootstrap.com/docs/standard/getting-started/" target="_blank" role="button">Start MDB tutorial</a>
                </div>
            </div>
        </div>
        @yield('content')
    </main>
</body>

<script type="text/javascript" src="{{ asset('js/mdb.umd.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/custom.js') }}"></script>

@yield('custom-script')

</html>