<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        /* General reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Body styling */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            display: flex;
            min-height: 100vh;
            flex-direction: column;
        }

        /* Navbar styling */
        .navbar {
            background-color: #333;
            padding: 10px 20px;
            color: #fff;
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
        }

        .navbar .navbar-brand {
            color: #4D9A94;
        }

        .navbar .nav-link {
            color: #fff;
            margin-right: 15px;
            transition: color 0.3s;
        }

        .navbar .nav-link:hover {
            color: white;
        }

        /* Sidebar styling */
        .sidebar {
            width: 250px;
            background-color: #333;
            color: #fff;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            position: fixed;
            top: 56px; /* Below the fixed navbar */
            left: 0;
            height: calc(100vh - 56px);
            padding: 20px;
        }

        .sidebar h2 {
            text-align: center;
            color: #4D9A94;
            font-size: 24px;
        }

        .sidebar ul {
            list-style-type: none;
            margin-top: 30px;
        }

        .sidebar ul li {
            margin: 20px 0;
        }

        .sidebar ul li a {
            color: #fff;
            text-decoration: none;
            font-size: 18px;
            padding: 10px;
            display: block;
            border-radius: 8px;
            transition: background-color 0.3s;
        }

        .sidebar ul li a:hover {
            background-color: #4D9A94;
        }

        /* Main content */
        .main-content {
            margin-left: 250px;
            margin-top: 56px; /* Prevent overlap with navbar */
            padding: 20px;
            width: calc(100% - 250px);
        }

        .main-content h1 {
            font-size: 32px;
            color: #333;
            margin-bottom: 20px;
        }

        /* Cards for key metrics */
        .dashboard-cards {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
        }

        .card {
            background-color: #fff;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            flex: 1;
            min-width: 250px;
        }

        .card h3 {
            font-size: 22px;
            color: #333;
            margin-bottom: 15px;
        }

        .card p {
            font-size: 28px;
            color: #4D9A94;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <div>
        <img src="{{asset('assets/img/logo/light_logo.png')}}" alt="logo" style="height: 50px; width: 130px;  margin-top: 0px; margin-bottom: 0px; margin-left:30px;">
                {{-- <img src="assets/img/logo/light_logo.png" alt="logo" style="height: 50px; width: 130px;  margin-top: 0px; margin-bottom: 25px;"> --}}
            </div>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Admin Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Profile</a>
                    </li>
                    <li class="nav-item">
                        <button class="btn btn-outline-info custom-hover p-0">
                        <a class="nav-link" href="{{ route('admin_logout') }}" 
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Logout
                        </a>
                    </button>
                        <form id="logout-form" action="{{ route('admin_logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                    
                </ul>
            </div>
        </div>
    </nav>

    <!-- Sidebar -->
    <div class="sidebar">
        
        <ul class="mt-0">
            <li><a href="{{ route('admin.dashboard') }}"> Admin Dashboard</a></li>
            <li><a href="profile">Profile</a></li>
            <li><a href="#">Manage Users</a></li>
            <li><a href="#">Manage Orders</a></li>
            <li><a href="{{ route('products.index') }}">Products</a></li>
            <li><a href="{{ route('categories.index') }}">Categories</a></li>
            <li><a href="#">Settings</a></li>
        </ul>
    </div>

    <!-- Main content -->
    <div class="main-content" style="margin-top: 80px ">
        @yield('content')
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
