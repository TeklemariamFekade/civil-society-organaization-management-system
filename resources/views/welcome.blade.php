<!DOCTYPE html>
<html>

<head>
    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.4.0/js/bootstrap.bundle.min.js"></script>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500;700;900&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="styles.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', 'Courier New', Courier, monospace;
            background-color: #ccccd2;
            height: 200vh;
        }

        .bg-light {
            background-color: #f0f0f0 !important;
        }

        .btn {
            font-weight: 500;
            transition: .5s;
        }

        .btn.btn-primary {
            color: #FFFFFF;
        }

        .btn-sm-square {
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 32px;
            height: 32px;
            font-weight: normal;
        }

        .navbar .dropdown-toggle::after {
            border: none;
            content: "\f107";
            font-family: "Font Awesome 5 Free";
            font-weight: 900;
            vertical-align: middle;
            margin-left: 8px;
        }

        .navbar-light .navbar-nav .nav-link {
            margin-right: 30px;
            padding: 25px 0;
            color: #FFFFFF;
            font-size: 15px;
            font-weight: 500;
            text-transform: uppercase;
            outline: none;
        }

        .navbar-light .navbar-nav .nav-link:hover,
        .navbar-light .navbar-nav .nav-link.active {
            color: blue;
        }

        @media (max-width: 991.98px) {
            .navbar-light .navbar-nav .nav-link {
                margin-right: 0;
                padding: 10px 0;
            }

            .navbar-light .navbar-nav {
                border-top: 1px solid #EEEEEE;
            }
        }

        .navbar-light .navbar-brand,
        .navbar-light a.btn {
            height: 75px;
        }

        .navbar-light .navbar-nav .nav-link {
            color: black;
            font-weight: 500;
        }

        .navbar-light.sticky-top {
            top: -100px;
            transition: .5s;
        }

        @media (min-width: 992px) {
            .navbar .nav-item .dropdown-menu {
                display: block;
                border: none;
                margin-top: 0;
                top: 150%;
                opacity: 0;
                visibility: hidden;
                transition: .5s;
            }

            .navbar .nav-item:hover .dropdown-menu {
                top: 100%;
                visibility: visible;
                transition: .5s;
                opacity: 1;
            }

            .containee {
                background-image: url("data:image/jpeg;base64,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");
            }
        }
    </style>
</head>

<body>

    @if (Route::has('login'))
    <div class="fixed-top m-3 text-end mt-1">
        @auth
        <a href="{{ url('/home') }}" class="btn btn-outline-primary">Home</a>
        @else
        <a href="{{ route('login') }}" class="btn btn-outline-primary">Log in</a>

        @if (Route::has('register'))
        <a href="{{ route('register') }}" class="btn btn-outline-primary ml-2">Register</a>
        @endif
        @endauth
    </div>
    @endif
    <!-- Topbar Start -->
    <div class="container-fluid bg-light p-0">
        <div class="row gx-0 d-none d-lg-flex">
            <div class="col-lg-7 px-5 text-start">
                <div class="h-100 d-inline-flex align-items-center py-3 me-4">
                    <small class="fa fa-map-marker-alt text-primary me-2"></small>
                    <small> Road, Mexico, Addis Ababa</small>
                </div>
                <div class="h-100 d-inline-flex align-items-center py-3">
                    <small class="far fa-clock text-primary me-2"></small>
                    <small id="current-date"></small>
                </div>
            </div>

        </div>
    </div>
    <!-- Topbar End -->

    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg bg-white navbar-light sticky-top p-0">
        <a href="index.html" class="navbar-brand d-flex align-items-center px-4 px-lg-5">
            <h2 class="m-0 text-primary">
                <img src="data:image/png;base64,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" alt="" style="width: 70px;">
            </h2>
        </a>
        <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto p-4 p-lg-0">
                <a href="#" class="nav-item nav-link active">Home</a>
                <a href="#" class="nav-item nav-link">About</a>
                <a href="#" class="nav-item nav-link">Service</a>
                <a href="#" class="nav-item nav-link">Project</a>
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Pages</a>
                    <div class="dropdown-menu fade-up m-0">
                        <a href="#" class="dropdown-item">Products</a>
                        <a href="#" class="dropdown-item">Our Team</a>
                        <a href="#" class="dropdown-item">Testimonial</a>
                        <a href="#" class="dropdown-item">Our Works</a>
                    </div>
                </div>
                <a href="#" class="nav-item nav-link">Contact</a>
            </div>
        </div>
    </nav>
    <!-- Navbar End -->
    <div class="containee">

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const currentDateElement = document.getElementById('current-date');
        const currentDate = new Date().toLocaleDateString();
        currentDateElement.textContent = currentDate;
    </script>
</body>

</html>
