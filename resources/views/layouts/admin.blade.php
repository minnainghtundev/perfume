<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfume Admin Panel</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
    
   
.navbar-custom {
    background-color: 	#434edf; /* Simplified background color */
}
.navbar-custom .navbar-brand,
.navbar-custom .navbar-nav .nav-link {
    color: #fff;
}
body {
    background-color: #dce9fd;
    
}
.navbar-brand {
    font-weight: bold;
    color: black;
}
.card {
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
}
.btn-delete {
    background-color: #ff4d4d;
    border: none;
}
.btn-update {
    background-color: #a5f241;
    border: none;
}
.form-control, .btn {
    border-radius: 10px;
}
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-custom" style="background-color: 	#67b3f1         ;">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/home') }}">PerfumeShop</a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                        @if (auth::check())
                            @if (auth::user()->name == "Y-perfume")
                                <li class="nav-item">
                                    <a class="nav-link" href=" {{ url('/admin/category/list')}} "> Category </a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" href=" {{ url('/admin/item/list')}} "> Product </a>
                                </li>

                            @endif 
                        @endif
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">

                    <!-- Shopping Cart  -->
                        <a href="{{ url('/item/shoppingCart') }}" style="background-color: #f89224;" class="btn btn-outline-dark"   >

                            <i class="fas fa-shopping-cart"></i>
                            Shopping Cart
                            [ {{ Session::has('cart') ? Session::get('cart')->totalQty : '' }} ] 
                            
                        </a>
                    <!-- End Shopping Cart -->

                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
</nav>
    <main class="py-4">
        @yield('content')
    </main>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>