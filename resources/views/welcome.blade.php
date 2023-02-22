@extends("layouts.app")
@section("content")
    <div id="app">
        <style>
            .logo-style {
                /*border-color: #0c4128;*/
                width: 100px;
                height: 100px;
            }

            .cart-style {
                width: 50px;
                height: 50px;
            }

            ul.demo {
                list-style-type: none;
                margin: 0;
                padding: 0;
            }

            .footer {
                position: fixed;
                left: 0;
                bottom: 0;
                width: 100%;
            }

        </style>
        <!-- carousel -->
        <div class="container">
            <div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel">
                <div class="btn-toolbar justify-content-center" style="margin-bottom: 24px;">
                    <div>
                        <div class="btn-group ml-4" style="margin-right: 10px;">
                            <select id="search_category" name="search_category" class="form-select form-select-sm">
                                <option selected value="1">Mobile Phones</option>
                                <option value="2">Accessories</option>
                            </select>
                        </div>
                        <div class="btn-group ml-4" style="margin-right: 10px;">
                            <input style="width: 320px;" class="form-control form-control-sm mr-sm-2" type="search"
                                   id="keyword" name="keyword" maxlength="100"
                                   placeholder="Text to search by product name and description"
                                   value="" aria-label="Search">
                        </div>
                        <div class="btn-group ml-4">
                            <a href="#" id="link" class="btn btn-sm btn-primary my-2 my-sm-0">
                                <i class="bi bi-search"></i>&nbsp;SEARCH
                            </a>
                        </div>
                    </div>
                </div>
{{--                <div class="carousel-inner">--}}
                    <div class="carousel-inner">
                        <div class="carousel-item active" data-bs-interval="2000">
                            <img src="{{asset('images/poster1.png')}}" class="d-block w-100" alt="poster1">
                        </div>
                        <div class="carousel-item" data-bs-interval="2000">
                            <img src="{{asset('images/poster2.png')}}" class="d-block  w-100" alt="poster2">
                        </div>
                        <div class="carousel-item">
                            <img src="{{asset('images/poster3.png')}}" class="d-block w-100"  alt="poster3">
                        </div>
                    </div>
{{--                </div>--}}
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval"
                        data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval"
                        data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
        <!-- choose-brand -->
        <div class="container">
            <div class="row mt-5">
                <div class="col-2">
                    <h1 class="h4 fw-bold">Choose By Brand</h1>
                    <br>
                </div>
            </div>
        </div>
        <div class="col-6">
            <!--<a href="#">View All</a> -->
        </div>
    </div>
    </div>
    {{--    border--}}
    <div class="container">
        <div class="d-flex d-sm-block d-md-flex justify-content-between">
            <div class="border border-success rounded-2" style="padding: 8px;">
                <a href="{{ url('/products/get-mobile-phones/search/apple') }}">
                    <img class="img-fluid logo-style " src="{{asset('images/apple-icon-4.png')}}" alt="">
                </a>
            </div>
            <div class="border border-success rounded-2" style="padding: 8px;">
                <a href="{{ url('/products/get-mobile-phones/search/mi') }}">
                    <img class="img-fluid logo-style" src="{{asset('images/mi1.png')}}" alt="">
                </a>
            </div>
            <div class="border border-success rounded-2" style="padding: 8px; margin-bottom: 0;">
                <a href="{{ url('/products/get-mobile-phones/search/samsung') }}">
                    <img class="img-fluid logo-style" src="{{asset('images/samsung-logo-1.png')}}" alt="">
                </a>
            </div>
            <div class="border border-success rounded-2" style="padding: 8px; margin-bottom: 0;">
                <a href="{{ url('/products/get-mobile-phones/search/huawei') }}">
                    <img class="img-fluid logo-style" src="{{asset('images/huawei.png')}}" alt="">
                </a>
            </div>
            <div class="border border-success rounded-2" style="padding: 8px; margin-bottom: 0;">
                <a href="{{ url('/products/get-mobile-phones/search/oppo') }}">
                    <img class="img-fluid logo-style" src="{{asset('images/Oppo-Logo.png')}}" alt="">
                </a>
            </div>
            <div class="border border-success rounded-2" style="padding: 8px; margin-bottom: 0;">
                <a href="{{ url('/products/get-mobile-phones/search/sony') }}">
                    <img class="img-fluid logo-style" src="{{asset('images/sony1.png')}}" alt="">
                </a>
            </div>
        </div>
    </div>
    {{--popular products--}}
    <div class="container mt-5">
        <div class="row">
            <div class="col-2">
            </div>
            <div class="col-6">
            <!--<a href="{{ url('/products/get-mobile-phones') }}">View All</a>-->
            </div>
        </div>
    </div>
    {{-- popular products' card lists--}}
    <div class="container">

    </div>

    <footer class="bg-secondary text-center text-lg-start">
        <!-- Grid container -->
        <div class="container p-2">
            <!--Grid row-->
            <div class="row">
                <!--Grid column-->
                <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                    <img src="{{asset('images/cart.png')}}"  class="cart-style" alt="">
                    <p class="fw-bold">ShopCart</p>
                </div>

                <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                    <ul class="list-unstyled mb-0">
                        <li><h5 class="fw-bold">Information</h5></li>
                        <a href="{{ url('/products/get-mobile-phones') }}" style="color: #0d6efd">
                            <li style="color: #0d6efd">Buy Mobile Phones</li>
                        </a>
                        <a href="{{ url('/products/get-accessories') }}" style="color: #0d6efd">
                            <li style="color: #0d6efd">Buy Accessories</li>
                        </a>
                    </ul>
                </div>

                <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                    <ul class="list-unstyled mb-0">
                        <li><h5 class="fw-bold">Contact us</h5></li>
                        <li class="pt-2"><i class="bi bi-telephone-forward-fill"></i> &nbsp;09 66554433
                        </li>
                        <li><i class="bi bi-envelope-at-fill"></i> &nbsp;mobile.store@shopcart.com
                        </li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                    <ul class="list-unstyled mb-0">
                        <li><h5 class="fw-bold">Follow us</h5></li>
                        <li class="pt-2">
                            <a style="text-decoration: none;color: #0d6efd" href="https://www.facebook.com"><i
                                    class="bi bi-facebook rounded-3 p-1 mt-1"></i> &nbsp;ShopCart</a>
                        </li>
                        <li>
                            <a style="text-decoration: none;color: #0d6efd" href="https://twitter.com/?lang=en"><i
                                    class="bi bi-twitter rounded-3 p-1 mt-1"></i> &nbsp;@shopCart</a>
                        </li>
                        <li>
                            <a style="text-decoration: none;color: #0d6efd" href="https://www.instagram.com/"><i
                                    class="bi bi-instagram rounded-3 p-1 mt-1"></i> &nbsp;@shop_cart</a>
                        </li>
                    </ul>
                </div>
                <!-- Copyright -->
                <div class="text-center p-1" style="background-color: #C0EEE4;">
                    <p>Copyright &copy; {{ date('Y') }} ShopCart by Thel Nu Aein. All Rights Reserved.</p>
                </div>
                <!-- Copyright -->
    </footer>


    <script>
        $(document).ready(function () {
            updateSearchLink("");
            $("#keyword").on('input', function () {
                var keyword = this.value;
                var category_id = document.getElementById("search_category").value;
                updateSearchLink(keyword, category_id);
            });
        });

        $("#search_category").on('change', function () {
            var category_id = this.value;
            var keyword = document.getElementById("keyword").value;
            updateSearchLink(keyword, category_id);
        });

        function updateSearchLink(keyword, category_id) {
            if (category_id === "1") {
                if (keyword === "") {
                    $('#link').attr('href', '/products/get-mobile-phones');
                } else {
                    $('#link').attr('href', '/products/get-mobile-phones/search/' + keyword);
                }
            } else {
                console.log("accessory");
                if (keyword === "") {
                    $('#link').attr('href', '/products/get-accessories');
                } else {
                    $('#link').attr('href', '/products/get-accessories/search/' + keyword);
                }
            }

        }
    </script>
@endsection
