<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token-front" content="{{ csrf_token() }}">
    <title>DL Cars Rental</title>


    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <!-- Google Fonts Roboto -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" />
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tarekraafat/autocomplete.js@10.2.7/dist/css/autoComplete.min.css">

    <link rel="stylesheet" href="{{asset('css/search.css')}}" />
    <link rel="stylesheet" href="{{asset('css/mdb.min.css')}}" />
    <link rel="stylesheet" href="{{asset('css/car-logo.css')}}" />
    <link rel="stylesheet" href="{{asset('css/home.css')}}" />
    <link rel="stylesheet" href="{{asset('css/custom.css')}}" />
    <link rel="stylesheet" href="{{asset('css/dlcar-sidenav.css')}}" />
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
                        <a class="navbar-brand mt-2 mt-lg-0" href="{{ route('home') }}">
                            <img src="{{ asset('img/logo.png') }}" height="40" alt="DLCars Logo" loading="lazy" />
                            <h2 class="text-primary m-0">DLCars</h2>
                        </a>
                        @yield('nav-categories')
                    </div>
                    <!-- Collapsible wrapper -->

                    @yield('nav-search')
                </div>
                <!-- Container wrapper -->
            </nav>
        </header>
        <div class="container py-4 m-0">
            @yield('content')
        </div>
    </main>
</body>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@tarekraafat/autocomplete.js@10.2.7/dist/autoComplete.min.js"></script>
<script type="text/javascript" src="{{ asset('js/mdb.umd.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/custom.js') }}"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token-front"]').attr('content')
        }
    });
</script>
@yield('custom-script')
@yield('search-script')
</html>