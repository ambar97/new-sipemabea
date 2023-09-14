<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/png"> -->
    <link rel="icon" href="https://external-content.duckduckgo.com/ip3/bcjember.beacukai.go.id.ico" type="image/png">
    <title>
        SIPEMABEA
    </title>

    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="{{ asset('Appland/assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <!-- {{ asset('Appland/assets/nama-file.css') }}
    helper asset(), Laravel akan secara otomatis menghasilkan URL yang benar,
    termasuk mempertimbangkan struktur path dari direktori public
    -->

    <link href="{{ asset('Appland/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('Appland/assets/vendor/icofont/icofont.min.css') }}" rel="stylesheet">
    <link href="{{ asset('Appland/assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('Appland/assets/vendor/owl.carousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('Appland/assets/vendor/venobox/venobox.css') }}" rel="stylesheet">
    <link href="{{ asset('Appland/assets/vendor/aos/aos.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('OwlCarousel/dist/assets/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('OwlCarousel/dist/assets/owl.theme.default.min.css') }}">
    <!-- 
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script> -->

    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <!-- Template Main CSS File -->
    <link href="{{ asset('Appland/assets/css/style.css') }}" rel="stylesheet">

    <script src="https://use.fontawesome.com/a0fe71fa47.js"></script>


</head>

<body>

    <!-- ======= Header ======= -->
    <header id="header" class="fixed-top  header-transparent ">
        <div class="container d-flex align-items-center">

            <div class="logo mr-auto">
                <!-- <h1 class="text-light"><a href="index.html">Appland</a></h1> -->
                <!-- Uncomment below if you prefer to use an image logo -->
                <a><img src="" alt="" class="img-fluid"> Login Admin</a>
            </div>
        </div>
    </header><!-- End Header -->

    <main id="main">
        <div class="container">

            @if ($errors->any())
            <div style="color: red;">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form method="POST" action="{{ route('admin.login') }}">
                @csrf
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required><br><br>

                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required><br><br>

                <button type="submit">Login</button>
            </form>
        </div>
    </main>

</html>