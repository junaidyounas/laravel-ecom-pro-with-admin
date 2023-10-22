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
                        <div class="row">
                            <div class="col-md-8 offset-md-2">

                                <div class="card-body">
                                    <h3>Order Details</h3>
                                    <p>Order ID: {{ $orderDetails['order']->id }}</p>
                                    <p>Order Date: {{ $orderDetails['order']->created_at }}</p>

                                    <h3>Ordered Products</h3>
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Product</th>
                                                    <th>Quantity</th>
                                                    <th>Price</th>
                                                    <!-- Add more table headers as needed -->
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($orderDetails['orderItems'] as $item)
                                                    <tr>
                                                        <td>{{ $item->product->title }}</td>
                                                        <td>{{ $item->quantity }}</td>
                                                        <td>${{ $item->product->price }}</td>
                                                        <!-- Add more table cells for additional product details -->
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
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
