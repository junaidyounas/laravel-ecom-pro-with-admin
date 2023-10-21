<!DOCTYPE html>
<html>

<head>
    <!-- Basic -->
    <meta charset="utf-8" />
    <base href="/public" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!-- Site Metas -->
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <link rel="shortcut icon" href="images/favicon.png" type="">
    <title>FARIG - Shopping Center</title>
    <!-- bootstrap core css -->
    <link rel="stylesheet" type="text/css" href="home/css/bootstrap.css" />
    <!-- font awesome style -->
    <link href="home/css/font-awesome.min.css" rel="stylesheet" />
    <!-- Custom styles for this template -->
    <link href="home/css/style.css" rel="stylesheet" />
    <!-- responsive style -->
    <link href="home/css/responsive.css" rel="stylesheet" />

    <style>
        .shop {
            font-size: 10px;
        }

        .space {
            letter-spacing: 0.8px !important;
        }

        .second a:hover {
            color: rgb(92, 92, 92);
        }

        .active-2 {
            color: rgb(92, 92, 92)
        }


        .breadcrumb>li+li:before {
            content: "" !important
        }

        .breadcrumb {
            padding: 0px;
            font-size: 10px;
            color: #aaa !important;
        }

        .first {
            background-color: white;
        }

        a {
            text-decoration: none !important;
            color: #aaa;
        }

        .btn-lg,
        .form-control-sm:focus,
        .form-control-sm:active,
        a:focus,
        a:active {
            outline: none !important;
            box-shadow: none !important
        }

        .form-control-sm:focus {
            border: 1.5px solid #ff7208;
        }

        .btn-group-lg>.btn,
        .btn-lg {
            padding: .5rem 0.1rem;
            font-size: 1rem;
            border-radius: 0;
            color: white !important;
            background-color: #ff7208;
            height: 2.8rem !important;
            border-radius: 0.2rem !important;
        }

        .btn-group-lg>.btn:hover,
        .btn-lg:hover {
            background-color: #ff7208;
        }

        .btn-outline-primary {
            background-color: #fff !important;
            color: #ff7208 !important;
            border-radius: 0.2rem !important;
            border: 1px solid #ff7208;
        }

        .btn-outline-primary:hover {
            background-color: #ff7208 !important;
            color: #fff !important;
            border: 1px solid #ff7208;
        }

        .card-2 {
            margin-top: 40px !important;
        }

        .card-header {
            background-color: #fff;
            border-bottom: 0px solid #aaaa !important;
        }

        p {
            font-size: 13px;
        }

        .small {
            font-size: 9px !important;
        }

        .form-control-sm {
            height: calc(2.2em + .5rem + 2px);
            font-size: .875rem;
            line-height: 1.5;
            border-radius: 0;
        }

        .cursor-pointer {
            cursor: pointer;
        }

        .boxed {
            padding: 0px 8px 0 8px;
            background-color: #ff7208;
            color: white;
        }

        .boxed-1 {
            padding: 0px 8px 0 8px;
            color: black !important;
            border: 1px solid #aaaa;
        }

        .bell {
            opacity: 0.5;
            cursor: pointer;
        }

        @media (max-width: 767px) {
            .breadcrumb-item+.breadcrumb-item {
                padding-left: 0
            }
        }
    </style>

</head>

<body>
    <div class="hero_area">
        <!-- header section strats -->
        @include('home.header')
        <!-- end header section -->

        {{-- Cart page start --}}
        <div class=" container-fluid my-5 ">
            <div class="row justify-content-center ">
                <div class="col-xl-10">
                    <div class="card shadow-lg ">
                        <div class="row p-2 mt-3 justify-content-between mx-sm-2">
                            <div class="col">
                                {{-- <p class="text-muted space mb-0 shop"> Shop Name: @isset($user) {{ $user->shop_name }} @endisset</p> --}}
                                {{-- <p class="text-muted space mb-0 shop">Store Locator</p> --}}
                            </div>
                            <div class="col">
                                <div class="row justify-content-start ">

                                </div>
                            </div>
                            {{-- <div class="col-auto">
                                <img class="irc_mi img-fluid bell" src="https://i.imgur.com/uSHMClk.jpg" width="30"
                                    height="30">
                            </div> --}}
                        </div>
                        <div class="col-12 justify-content-center text-center">
                            <img class="irc_mi img-fluid cursor-pointer " src="logo.png" width="120" height="70">
                        </div>
                        <div class="row  mx-auto justify-content-center text-center">
                            <div class="col-12 mt-0 ">
                                <nav aria-label="breadcrumb" class="second ">
                                    <ol class="breadcrumb indigo lighten-6 first  ">
                                        {{-- <li class="breadcrumb-item font-weight-bold "><a
                                                class="black-text text-uppercase " href="#"><span
                                                    class="mr-md-3 mr-1">BACK TO SHOP</span></a><i
                                                class="fa fa-angle-double-right " aria-hidden="true"></i></li>
                                        <li class="breadcrumb-item font-weight-bold"><a
                                                class="black-text text-uppercase" href="#"><span
                                                    class="mr-md-3 mr-1">SHOPPING BAG</span></a><i
                                                class="fa fa-angle-double-right text-uppercase " aria-hidden="true"></i>
                                        </li> --}}
                                        <li class="breadcrumb-item font-weight-bold"><a
                                                class="black-text text-uppercase active-2" href="#"><span
                                                    class="mr-md-3 mr-1">CHECKOUT</span></a></li>
                                    </ol>
                                </nav>
                            </div>
                        </div>

                        <div class="row justify-content-around">
                            <div class="col-md-5">
                                <div class="card border-0">
                                    <div class="card-header pb-0">
                                        <h2 class="card-title space ">Checkout</h2>
                                        <p class="card-text text-muted mt-4  space">SHIPPING DETAILS</p>
                                        <hr class="my-0">
                                    </div>
                                    <div class="card-body">
                                        <div class="row justify-content-between">
                                            <div class="col-auto mt-0">
                                                <p><b>Please fill the form to complete the order</b></p>
                                            </div>
                                            {{-- <div class="col-auto">
                                                <p><b>BBBootstrap@gmail.com</b> </p>
                                            </div> --}}
                                        </div>
                                        <div class="row mt-4">
                                            <div class="col">
                                                <p class="text-muted mb-2">PAYMENT DETAILS</p>
                                                <hr class="mt-0">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="NAME" class="small text-muted mb-1">NAME</label>
                                            <input type="text" class="form-control form-control-sm" name="name"
                                                id="NAME" aria-describedby="helpId" placeholder="Name">
                                        </div>
                                        <div class="form-group">
                                            <label for="PHONE" class="small text-muted mb-1">PHONE</label>
                                            <input type="number" class="form-control form-control-sm" name="phone"
                                                id="NAME" aria-describedby="helpId" placeholder="Phone number">
                                        </div>
                                        <div class="form-group">
                                            <label for="ADDRESS" class="small text-muted mb-1">ADDRESS</label>
                                            <input type="text" class="form-control form-control-sm" name="address"
                                                id="NAME" aria-describedby="helpId" placeholder="Address">
                                        </div>
                                        <div class="row no-gutters">
                                            <div class="col-sm-6 pr-sm-2">
                                                <div class="form-group">
                                                    <label for="POST CODE" class="small text-muted mb-1">Postal
                                                        Code</label>
                                                    <input type="text" class="form-control form-control-sm"
                                                        name="postal_code" id="NAME" aria-describedby="helpId"
                                                        placeholder="Enter your post code">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="PROVINCE"
                                                        class="small text-muted mb-1">PROVINCE</label>
                                                    <input type="text" class="form-control form-control-sm"
                                                        name="province" id="NAME" aria-describedby="helpId"
                                                        placeholder="Enter your province">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-md-5">
                                            <div class="col">
                                                <button type="button" name="" id=""
                                                    class="btn  btn-lg btn-block ">PURCHASE NOW</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="card border-0 ">
                                    <div class="card-header card-2">
                                        <p class="card-text text-muted mt-md-4  mb-2 space">YOUR ORDER <span
                                                class=" small text-muted ml-2 cursor-pointer">EDIT SHOPPING BAG</span>
                                        </p>
                                        <hr class="my-2">
                                    </div>
                                    <div class="card-body pt-0">
                                        @isset($items) 
                                        @foreach ($items as $item)
                                            <hr class="my-2">
                                            <div class="row  justify-content-between">
                                                <div class="col-auto col-md-7">
                                                    <div class="media flex-column flex-sm-row">
                                                        <img class=" img-fluid " style="padding-right: 20px;"
                                                            src="product_images/{{ collect($item->product->images)->first()->image_name }}"
                                                            width="80" height="80">
                                                        <div class="media-body  my-auto">
                                                            <div class="row ">
                                                                <div class="col">
                                                                    <p class="mb-0">
                                                                        <b>{{ $item->product->title }}</b>
                                                                    </p>
                                                                    <small
                                                                        class="text-muted">{{ strlen($item->product->description) > 100 ? substr($item->product->description, 0, 100) . '...' : $item->product->description }}</small>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="pl-0 flex-sm-col col-auto  my-auto">
                                                    <p class="boxed">{{ $item->quantity ?? '' }}</p>
                                                </div>
                                                <div class="pl-0 flex-sm-col col-auto my-auto">
                                                    <p><b>{{ $item->product->price ?? '' }} Rs</b></p>
                                                </div>
                                                <form style="background: transparent; border: none;" method="POST"
                                                    action="{{ url('cart/remove', $item->product->id) }}" class="option2">
                                                    @csrf {{-- Add a CSRF token to the form for security --}}
                                                    <div class="pl-0 flex-sm-col col-auto my-auto ">
                                                        <button
                                                            style="border: none; background: none; padding: 0; margin: 0; cursor: pointer;"
                                                            type="submit">
                                                            <a style="color: #fff" class="option2 boxed">
                                                                x
                                                            </a>
                                                        </button>
                                                    </div>

                                                </form>
                                            </div>
                                        @endforeach
                                        @endisset
                                        <hr class="my-2">
                                        <div class="row ">
                                            <div class="col">
                                                <div class="row justify-content-between">
                                                    <div class="col-4">
                                                        <p class="mb-1"><b>Subtotal</b></p>
                                                    </div>
                                                    <div class="flex-sm-col col-auto">
                                                        <p class="mb-1"><b>@isset($subtotal) {{ $subtotal }} @endisset Rs</b></p>
                                                    </div>
                                                </div>
                                                <div class="row justify-content-between">
                                                    <div class="col">
                                                        <p class="mb-1"><b>Shipping</b></p>
                                                    </div>
                                                    <div class="flex-sm-col col-auto">
                                                        <p class="mb-1"><b>200 Rs</b></p>
                                                    </div>
                                                </div>
                                                <div class="row justify-content-between">
                                                    <div class="col-4">
                                                        <p><b>Total</b></p>
                                                    </div>
                                                    <div class="flex-sm-col col-auto">
                                                        <p class="mb-1"><b>@isset($total) {{ $total }} @endisset Rs</b></p>
                                                    </div>
                                                </div>
                                                <hr class="my-0">
                                            </div>
                                        </div>
                                        {{-- <div class="row mb-5 mt-4 ">
                                            <div class="col-md-7 col-lg-6 mx-auto"><button type="button"
                                                    class="btn btn-block btn-outline-primary btn-lg">ADD GIFT
                                                    CODE</button></div>
                                        </div> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- Cart page end --}}

        <!-- footer start -->
        @include('home.footer')
        <!-- footer end -->
        <div class="cpy_">
            <p class="mx-auto">© 2021 All Rights Reserved By <a href="https://html.design/">Free Html
                    Templates</a><br>

                Distributed By <a href="https://themewagon.com/" target="_blank">ThemeWagon</a>

            </p>
        </div>
        <!-- jQery -->
        <script src="home/js/jquery-3.4.1.min.js"></script>
        <!-- popper js -->
        <script src="home/js/popper.min.js"></script>
        <!-- bootstrap js -->
        <script src="home/js/bootstrap.js"></script>
        <!-- custom js -->
        <script src="home/js/custom.js"></script>
</body>

</html>
