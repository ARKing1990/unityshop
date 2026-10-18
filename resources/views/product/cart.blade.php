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
        <!--Isi-->

		<div class="untree_co-section before-footer-section">
            <div class="container">
              <div class="row mb-5">
                <form class="col-md-12" method="post">
                  <div class="site-blocks-table">
					<div class="page-content">
                    <table class="table">
                      <thead>
                        <tr>
                          <th class="product-thumbnail">Image</th>
                          <th class="product-name">Product</th>
                          <th class="product-price">Price</th>
                          <th class="product-quantity">Quantity</th>
                          <th class="product-total">Total</th>
                          <th class="product-remove">Remove</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td class="product-thumbnail">
                            <img src="assets/images/product-1.png" alt="Image" class="img-fluid">
                          </td>
                          <td class="product-name">
                            <h2 class="h5 text-white">Product 1</h2>
                          </td>
                          <td class="h6 text-white">$49.00</td>
                          <td>
                            <div class="input-group mb-3 d-flex align-items-center quantity-container" style="max-width: 120px;">
                              <div class="input-group-prepend">
                                <button class="btn btn-outline-white decrease"  type="button">&minus;</button>
                              </div>
                              <input type="text" class="form-control text-center quantity-amount" value="1" placeholder="" aria-label="Example text with button addon" aria-describedby="button-addon1">
                              <div class="input-group-append">
                                <button class="btn btn-outline-white increase" type="button">&plus;</button>
                              </div>
                            </div>

                          </td>
                          <td class="h6 text-white">$49.00</td>
                          <td><a href="#" class="h6 text-white">X</a></td>
                        </tr>

                        <tr>
                          <td class="product-thumbnail">
                            <img src="assets/images/product-2.png" alt="Image" class="img-fluid">
                          </td>
                          <td class="product-name">
                            <h2 class="h5 text-white">Product 2</h2>
                          </td>
                          <td class="h6 text-white">$49.00</td>
                          <td>
                            <div class="input-group mb-3 d-flex align-items-center quantity-container" style="max-width: 120px;">
                              <div class="input-group-prepend">
                                <button class="btn btn-outline-white decrease" type="button">&minus;</button>
                              </div>
                              <input type="text" class="form-control text-center quantity-amount" value="1" placeholder="" aria-label="Example text with button addon" aria-describedby="button-addon1">
                              <div class="input-group-append">
                                <button class="btn btn-outline-white increase" type="button">&plus;</button>
                              </div>
                            </div>

                          </td>
                          <td class="h6 text-white">$49.00</td>
                          <td><a href="#" class="h6 text-white">X</a></td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </form>
              </div>
			</div>

              <div class="row">
                <div class="col-md-6">
                  <div class="row mb-5">
                    <div class="col-md-6 mb-3 mb-md-0">
                      <button class="btn btn-white btn-sm btn-block">Update Cart</button>
                    </div>
                    <div class="col-md-6">
                      <button class="btn btn-outline-white btn-sm btn-block">Continue Shopping</button>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <label class="text-white h4" for="coupon">Coupon</label>
                      <p>Enter your coupon code if you have one.</p>
                    </div>
                    <div class="col-md-8 mb-3 mb-md-0">
                      <input type="text" class="form-control py-3" id="coupon" placeholder="Coupon Code">
                    </div>
                    <div class="col-md-4">
                      <button class="btn btn-white">Apply Coupon</button>
                    </div>
                  </div>
                </div>
                <div class="col-md-6 pl-5">
                  <div class="row justify-content-end">
                    <div class="col-md-7">
                      <div class="row">
                        <div class="col-md-12 text-right border-bottom mb-5">
                          <h3 class="text-white h4 text-uppercase">Cart Totals</h3>
                        </div>
                      </div>
                      <div class="row mb-3">
                        <div class="col-md-6">
                          <span class="text-white">Subtotal</span>
                        </div>
                        <div class="col-md-6 text-right">
                          <strong class="text-white">$230.00</strong>
                        </div>
                      </div>
                      <div class="row mb-5">
                        <div class="col-md-6">
                          <span class="text-white">Total</span>
                        </div>
                        <div class="col-md-6 text-right">
                          <strong class="text-white">$230.00</strong>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-12">
                          <button class="btn btn-white btn-lg py-3 btn-block" onclick="window.location='checkout.html'">Proceed To Checkout</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
        </div>
		<!-- End Isi-->
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
