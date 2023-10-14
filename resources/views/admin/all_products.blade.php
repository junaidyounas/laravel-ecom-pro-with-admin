<!DOCTYPE html>
<html lang="en">

<head>
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
                                <h4 class="card-title">All Products</h4>
                                <p class="card-description"> Edit and delete product
                                </p>
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Title</th>
                                                <th>Price</th>
                                                <th>Disc Price</th>
                                                <th>Category</th>
                                                <th>Description</th>
                                                <th>Quantity</th>
                                                <th>Image</th>
                                                <th>Created</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($products as $product)
                                                <tr>
                                                    <td>{{ $product->id }}</td>
                                                    <td>{{ $product->title }}</td>
                                                    <td>{{ $product->price }}</td>
                                                    <td>{{ $product->discount_price }}</td>
                                                    <td>{{ $product->category }}</td>
                                                    <td>{{ $product->description }}</td>
                                                    <td>{{ $product->quantity }}</td>
                                                    <td>{{ $product->images }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($product->created_at)->format('d F Y') }}
                                                    </td>
                                                    <td><a
                                                            href="{{ url('edit_product', $product->id) }}"><label
                                                                class="badge badge-success">Update</label></a></td>
                                                                
                                                    <td><a onclick="delete_confirmation(event)"
                                                            href="{{ url('delete_product', $product->id) }}"><label
                                                                class="badge badge-danger">Delete</label></a></td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
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
