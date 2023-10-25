<!DOCTYPE html>
<html lang="en">

<head>
    <base href="/public" />

    @include('admin.css')
</head>

<body>
    <div class="container-scroller">
        <!-- partial:partials/_sidebar.html -->
        @include('admin.sidebar')
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_navbar.html -->
            @include('admin.header')
            <!-- partial -->
            <div class="main-panel">
                @if (session()->has('message'))
                    <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                        {{ session()->get('message') }}
                    </div>
                @endif
                <div class="content-wrapper">
                    {{-- Products show --}}
                    <div class="col-lg-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">All Orders</h4>

                                <p class="card-description"> Edit Order
                                </p>


                                <div class="card-body">
                                    <h3>Order Details</h3>
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <tbody>
                                                <tr>
                                                    <td>Order ID</td>
                                                    <td>{{ $orderDetails['order']->id }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Name</td>
                                                    <td>{{ $orderDetails['order']->name }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Phone</td>
                                                    <td>{{ $orderDetails['order']->phone }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Address</td>
                                                    <td>{{ $orderDetails['order']->address }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Province</td>
                                                    <td>{{ $orderDetails['order']->province }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Post Code</td>
                                                    <td>{{ $orderDetails['order']->post_code }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Reference</td>
                                                    <td>{{ $orderDetails['order']->reference }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Order Date</td>
                                                    <td>{{ \Carbon\Carbon::parse($orderDetails['order']->created_at)->format('d F Y') }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Updated Date</td>
                                                    <td>{{ \Carbon\Carbon::parse($orderDetails['order']->updated_at)->format('d F Y') }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Order Status</td>
                                                    <td>{{ $orderDetails['order']->status }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                    


                                    <h3>Ordered Products</h3>
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Product</th>
                                                    <th>Price</th>
                                                    <th>Discount Price</th>
                                                    <th>Quantity</th>
                                                    <th>Image</th>
                                                    <!-- Add more table headers as needed -->
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($orderDetails['orderItems'] as $item)
                                                    <tr>
                                                        <td>{{ $item->product->id }}</td>
                                                        <td>{{ $item->product->title }}</td>
                                                        <td>Rs {{ $item->product->price }}</td>
                                                        <td>Rs {{ $item->product->discount_price }}</td>
                                                        <td>{{ $item->quantity }}</td>
                                                        <td><img style="border-radius: 0%;width: 120px; height: 120px;"
                                                                width="120px" height="120px"
                                                                src="product_images/{{ collect($item->product->images)->first()->image_name }}" />
                                                        </td>

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
                    {{-- Product show ends --}}

                </div>


            </div>
            <!-- main-panel ends -->

        </div>

        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    @include('admin.script')
    <script>
        function delete_confirmation(ev) {
            ev.preventDefault();
            var urlToRedirect = ev.currentTarget.getAttribute('href');
            swal({
                title: 'Delete Confirmation',
                text: 'Are you sure you want to delete',
                icon: 'warning',
                buttons: true,
                dangerMode: true,
            }).then((willCancel) => {
                if (willCancel) {
                    window.location.href = urlToRedirect;
                }
            })
        }
    </script>
</body>

</html>
