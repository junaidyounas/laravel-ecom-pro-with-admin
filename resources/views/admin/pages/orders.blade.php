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
                                <h4 class="card-title">All Orders</h4>

                                <p class="card-description"> Edit Order
                                </p>
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Order ID</th>
                                                <th>Name</th>
                                                <th>Phone</th>
                                                <th>Created</th>
                                                <th>Updated</th>
                                                <th>Status</th>
                                                <th>Change Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($orders as $order)
                                                <tr>
                                                    <td>{{ $order->id }}</td>
                                                    <td>{{ $order->name }}</td>
                                                    <td>{{ $order->phone }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($order->created_at)->format('d F Y') }}
                                                    <td>{{ \Carbon\Carbon::parse($order->updated_at)->format('d F Y') }}
                                                    <td class="{{ $order->status !== 'completed' ? 'text-danger' : 'text-success' }}">{{ $order->status }}</td>
                                                    <td>
                                                        <form method="POST"
                                                            action="{{ url('update_order_status', $order->id) }}">
                                                            @csrf
                                                            <select name="status" class="form-control"
                                                                id="exampleSelectStatus">
                                                                <option value="processing"
                                                                    {{ $order->status === 'processing' ? 'selected' : '' }}>
                                                                    Processing</option>
                                                                <option value="dispatched"
                                                                    {{ $order->status === 'dispatched' ? 'selected' : '' }}>
                                                                    Dispatched</option>
                                                                <option value="delivered"
                                                                    {{ $order->status === 'delivered' ? 'selected' : '' }}>
                                                                    Delivered</option>
                                                                <option value="completed"
                                                                    {{ $order->status === 'completed' ? 'selected' : '' }}>
                                                                    Completed</option>
                                                            </select>
                                                            <button style="margin-top: 10px;" type="submit"
                                                                class="btn btn-primary">Update</button>
                                                        </form>
                                                    </td>
                                                    <td><a href="{{ url('edit_product', $order->id) }}"><label
                                                                class="badge badge-success">Open</label></a></td>

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
