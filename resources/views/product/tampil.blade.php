<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Unity Shop - Outfit Store</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}" />
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="{{ asset('css/styleslanding.css') }}" rel="stylesheet" />
    <style>
        .dropdown:hover > .dropdown-menu{
            display: block;
        }
        .bg-landing{
            background-color: #27374D;
        }
    </style>
</head>
<body>
    <!-- Navigation-->
    <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-landing py-4">
        <div class="container px-4 px-lg-5">
            <a class="navbar-brand" href="{{route('landing')}}">UNITY SHOP</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse text-uppercase" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                    <li class="nav-item"><a class="nav-link active" aria-current="page" href="{{route('landing')}}">Home</a></li>

                    <li class="nav-item dropdown">
                        <a class="nav-link" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Categories</a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            @foreach ($categories as $category)
                                <li><a class="dropdown-item" href="{{ route('landing', ['category' => $category->name]) }}">{{ $category->name }}</a></li>
                            @endforeach
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Brands</a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            @foreach ($brands as $brand)
                                <li><a class="dropdown-item" href="{{ route('landing', ['brand' => $brand->name]) }}">{{ $brand->name }}</a></li>
                            @endforeach
                        </ul>
                    </li>
                </ul>
                <form class="d-flex">
                    <a class="btn btn-outline-light" role="button" href="#">
                        <i class="bi-cart-fill me-1"></i>
                        Cart
                    </a>
                    @auth
                        <a href="{{ route('dashboard') }}" class="btn btn-outline-light ms-1">
                            <i class="bi-person-fill me-1"></i>
                            Dashboard
                        </a>
                    @endauth
                    @guest
                        <a href="{{ route('login') }}" class="btn btn-outline-light ms-1">
                            <i class="bi-person-fill me-1"></i>
                            Login
                        </a>
                    @endguest
                </form>
            </div>
        </div>
    </nav>
    <!-- Product section-->
    <section class="py-5">
        <div class="container px-4 px-lg-5 my-5">
            <div class="row gx-4 gx-lg-5 align-items-center">
                @if ($product->image)
                    <div class="col-md-6"><img class="card-img-top mb-5 mb-md-0" src="{{ asset('storage/product/' . $product->image) }}" alt="{{$product->image}}" /></div>
                @else
                    <div class="col-md-6"><img class="card-img-top mb-5 mb-md-0" src="{{ asset('images/default-product-detail.png') }}" alt="default-image" /></div>
                @endif

                <div class="col-md-6">
                    <div class="small mb-1">SKU: BST-498</div>
                    <h1 class="display-5 fw-bolder">{{ $product->name }}</h1>
                    <div class="fs-5 mb-5">
                        @if ($product['sale_price'] != 0)
                                            <span class="text-muted text-decoration-line-through">Rp.{{ number_format($product->price, 0) }}</span>
                                            Rp.{{ number_format($product->sale_price, 0) }}
                                        @else
                                            Rp.{{ number_format($product->price, 0) }}
                                        @endif
                    </div>
                    <p class="lead">Lorem ipsum dolor sit amet consectetur adipisicing elit. Praesentium at dolorem quidem modi. Nam sequi consequatur obcaecati excepturi alias magni, accusamus eius
                        blanditiis delectus ipsam minima ea iste laborum vero?</p>
                    <div class="d-flex">
                        <input class="form-control text-center me-3" id="inputQuantity" type="num" value="1" style="max-width: 3rem" />
                        <button class="btn btn-outline-dark flex-shrink-0" type="button">
                            <i class="bi-cart-fill me-1"></i>
                            Add to cart
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Related items section-->
    <section class="py-5 bg-light">
        <div class="container px-4 px-lg-5 mt-5">
            <h2 class="fw-bolder mb-4">Related products</h2>
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                @foreach ($related as $product)
                    <div class="col mb-5">
                        <div class="card h-100">
                            <!-- Product image-->
                            @if ($product->image)
                                <img class="card-img-top" src="{{ asset('storage/product/' . $product->image) }}" alt="..." />
                            @else
                                <img class="card-img-top" src="{{ asset('images/default-product.png') }}" alt="..." />
                            @endif
                            <!-- Product details-->
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <!-- Product name-->
                                    <h5 class="fw-bolder">{{ $product->name }}</h5>
                                    <!-- Product price-->
                                    @if ($product['sale_price'] != 0)
                                            <span class="text-muted text-decoration-line-through">Rp.{{ number_format($product->price, 0) }}</span>
                                            Rp.{{ number_format($product->sale_price, 0) }}
                                        @else
                                            Rp.{{ number_format($product->price, 0) }}
                                        @endif
                                </div>
                            </div>
                            <!-- Product actions-->
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="#">View options</a></div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- Footer-->
    <footer class="py-5 bg-dark">
        <div class="container">
            <p class="m-0 text-center text-white">Copyright &copy; Your Website 2023</p>
        </div>
    </footer>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="{{ asset('js/scripts.js') }}"></script>
</body>

</html>
