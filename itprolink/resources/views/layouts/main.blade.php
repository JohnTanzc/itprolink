<!DOCTYPE html>
<html lang="zxx" class="no-js">

<head>
    <!-- Mobile Specific Meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('template/img/fav.png') }}" />
    <!-- Author Meta -->
    <meta name="author" content="colorlib" />
    <!-- Meta Description -->
    <meta name="description" content="" />
    <!-- Meta Keyword -->
    <meta name="keywords" content="" />
    <!-- meta character set -->
    <meta charset="UTF-8" />
    <!-- Site Title -->
    <title>ITProLink</title>

    <link href="https://fonts.googleapis.com/css?family=Playfair+Display:900|Roboto:400,400i,500,700"
        rel="stylesheet" />
    <!--
      CSS
      =============================================
    -->
    <link rel="stylesheet" href="{{ asset('template/css/linearicons.css') }}" />
    <link rel="stylesheet" href="{{ asset('template/css/font-awesome.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('template/css/bootstrap.css') }}" />
    <link rel="stylesheet" href="{{ asset('template/css/magnific-popup.css') }}" />
    <link rel="stylesheet" href="{{ asset('template/css/owl.carousel.css') }}" />
    <link rel="stylesheet" href="{{ asset('template/css/nice-select.css') }}">
    <link rel="stylesheet" href="{{ asset('template/css/hexagons.min.css') }}" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/themify-icons/0.1.2/css/themify-icons.css" />
    <link rel="stylesheet" href="{{ asset('template/css/main.css') }}" />
    @stack('styles')
</head>

<body>

    @yield('content')
    <script src="{{ asset('template/js/vendor/jquery-2.2.4.min.js') }}"></script>
    <script src="{{ asset('template/js/vendor/bootstrap.min.js') }}"></script>
    <script src="{{ asset('template/js/jquery.ajaxchimp.min.js') }}"></script>
    <script src="{{ asset('template/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('template/js/parallax.min.js') }}"></script>
    <script src="{{ asset('template/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('template/js/jquery.sticky.js') }}"></script>
    <script src="{{ asset('template/js/hexagons.min.js') }}"></script>
    <script src="{{ asset('template/js/jquery.counterup.min.js') }}"></script>
    <script src="{{ asset('template/js/waypoints.min.js') }}"></script>
    <script src="{{ asset('template/js/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('template/js/main.js') }}"></script>
    <script type="text/javascript"
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBhOdIF3Y9382fqJYt5I_sswSrEw5eihAA"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"
        integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous">
    </script>
    @stack('scripts')
</body>

</html>
