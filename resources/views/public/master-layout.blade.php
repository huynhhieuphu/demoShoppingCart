<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <meta name="description" content=""/>
    <meta name="author" content=""/>
    <title>Shop Homepage - Start Bootstrap Template</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="{{asset('public/assets/favicon.ico')}}"/>
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet"/>
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="{{asset('public/css/styles.css')}}" rel="stylesheet"/>
    <style>
        body, html {
            height: 100%;
        }

        header.banner {
            background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)),
                url({{asset('asset/uploads/banners/'. $bannerShop->images)}});
            height: 50%;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }
    </style>
</head>
<body>
<!-- Navigation-->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container px-4 px-lg-5">
        <a class="navbar-brand" href="{{route('home.index')}}">Shopping Demo</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span
                class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4 menu-left">
                <li class="nav-item"><a class="nav-link" aria-current="page" href="#">About</a></li>
                @foreach($parentCategories as $category)
                    <li class="nav-item"><a
                            class="nav-link {{ 'the-loai/' . $category->slug == Request::path() ? 'active' : '' }}"
                            href="{{route('home.category',['slug' => $category->slug])}}">{{$category->name}}</a>
                    </li>
                @endforeach
                <li class="nav-item"><a
                        class="nav-link {{ Route::currentRouteNamed('home.from.contact') ? 'active' : '' }}"
                        aria-current="page" href="{{route('home.from.contact')}}">Liên hệ</a></li>
                {{--                <li class="nav-item dropdown">--}}
                {{--                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button"--}}
                {{--                       data-bs-toggle="dropdown" aria-expanded="false">Shop</a>--}}
                {{--                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">--}}
                {{--                        <li><a class="dropdown-item" href="#!">All Products</a></li>--}}
                {{--                        <li>--}}
                {{--                            <hr class="dropdown-divider"/>--}}
                {{--                        </li>--}}
                {{--                        <li><a class="dropdown-item" href="#!">Popular Items</a></li>--}}
                {{--                        <li><a class="dropdown-item" href="#!">New Arrivals</a></li>--}}
                {{--                    </ul>--}}
                {{--                </li>--}}
            </ul>
            <div class="d-flex">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0 mx-2">
                    @if(Auth::guard('cus')->check())
                        <li class="nav-item dropdown">
                            <a class="nav-link active dropdown-toggle" id="navbarDropdownRight" href="#" role="button"
                               data-bs-toggle="dropdown"
                               aria-expanded="false">{{Auth::guard('cus')->user()->username}}</a>
                            <ul class="dropdown-menu dropdown-menu-start" aria-labelledby="navbarDropdownRight">
                                <li><a class="dropdown-item" href="{{route('admin.customer.logout')}}">Logout</a></li>
                            </ul>
                        </li>
                    @else
                        <li class="nav-item"><a class="nav-link active" aria-current="page"
                                                href="{{route('admin.customer.login.form')}}">Đăng nhập</a></li>
                    @endif
                </ul>
                <a href="{{route('cart.index')}}" class="btn btn-outline-dark">
                    <i class="bi-cart-fill me-1"></i>
                    Cart
                    <span class="badge bg-dark text-white ms-1 rounded-pill">{{$cart->totalQuantity}}</span>
                </a>
            </div>
        </div>
    </div>
</nav>
<!-- Header-->
<header class="py-5 banner">
    <div class="container px-4 px-lg-5 my-5">
        <div class="text-center text-white">
            <h1 class="display-4 fw-bolder">Shop in style</h1>
            <p class="lead fw-normal text-white-50 mb-0">With this shop hompeage template</p>
        </div>
    </div>
</header>

@yield('content')

<!-- Footer-->
<footer class="py-5 bg-dark">
    <div class="container"><p class="m-0 text-center text-white">Copyright &copy; Your Website 2021</p></div>
</footer>
<!-- Bootstrap core JS-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
<!-- Core theme JS-->
<script src="{{asset('public/js/scripts.js')}}"></script>
@stack('script')
</body>
</html>
