<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin.css')
</head>
<x-success />

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
                                <h4 class="card-title">All Site Users</h4>

                                <p class="card-description"> Edit users
                                </p>
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Name</th>
                                                <th>Phone</th>
                                                <th>Active</th>
                                                <th>Email</th>
                                                <th>Address</th>
                                                <th>Created at</th>
                                                <th>Updated at</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($users as $user)
                                                <tr>
                                                    <td>{{ $user->id }}</td>
                                                    <td>{{ $user->name }}</td>
                                                    <td>{{ $user->phone }}</td>
                                                    <td>
                                                        <div class="dropdown">
                                                            <button
                                                                class="btn btn-{{ $user->is_active == 1 ? 'success' : 'danger' }} dropdown-toggle"
                                                                type="button"
                                                                id="dropdownMenuIconButton{{ $user->id }}"
                                                                data-toggle="dropdown" aria-haspopup="true"
                                                                aria-expanded="false">
                                                                {{ $user->is_active == 1 ? 'Yes' : 'No' }}
                                                            </button>
                                                            <div class="dropdown-menu"
                                                                aria-labelledby="dropdownMenuIconButton{{ $user->id }}">
                                                                <a onclick="activate_user(event)"
                                                                    href="/superuser/shops" style="color: green"
                                                                    class="dropdown-item activate-user"
                                                                    data-user-id="{{ $user->id }}">Activate</a>
                                                                <a onclick="deactivate_user(event)"
                                                                    href="/superuser/shops" style="color: red"
                                                                    class="dropdown-item deactivate-user"
                                                                    data-user-id="{{ $user->id }}">Deactivate</a>
                                                            </div>
                                                        </div>
                                </div>
                                </td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->address }}</td>
                                <td>{{ \Carbon\Carbon::parse($user->created_at)->format('d F Y') }}</td>
                                <td>{{ \Carbon\Carbon::parse($user->updated_at)->format('d F Y') }}</td>

                                {{-- <td><a
                                                            href="{{ url('edit_product', $user->id) }}"><label
                                                                class="badge badge-success">Update</label></a></td>

                                                    <td><a onclick="delete_confirmation(event)"
                                                            href="{{ url('delete_product', $user->id) }}"><label
                                                                class="badge badge-danger">Delete</label></a></td> --}}
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


    <script>
        function updateButtonStatus(userId, userStatus) {

            var button = $(`#dropdownMenuIconButton${userId}`);
            button.text(userStatus);
            $(`#dropdownMenuIconButton${userId}`).text(userStatus);
            if (userStatus == 'Yes') {
                $(`#dropdownMenuIconButton${userId}`).toggleClass('btn-danger btn-success');

            } else {
                $(`#dropdownMenuIconButton${userId}`).toggleClass('btn-success btn-danger');

            }
        }

        function performUserAction(userId, action, callback) {
            var formData = new FormData();
            formData.append('_token', '{{ csrf_token() }}');
            formData.append('user_id', userId);

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                url: `/superuser/shops/${userId}/${action}`,
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(data) {
                    console.log("AJAX Request Successful");
                    updateButtonStatus(userId, action == 'activate' ? 'Yes' : 'No');
                },
                error: function(xhr, status, error) {
                    console.log("AJAX Request Failed");
                    console.log(error); // Log any errors for debugging
                }
            });
        }


        function activate_user(ev) {
            ev.preventDefault();
            var userId = $(ev.currentTarget).data("user-id"); // Get the user ID

            swal({
                title: 'Activate User',
                text: 'Are you sure you want to activate',
                icon: 'warning',
                buttons: true,
                dangerMode: true,
            }).then((willCancel) => {
                if (willCancel) {
                    console.log('willCanel 193', willCancel, userId);

                    performUserAction(userId, 'activate');
                }
            })
        }

        function deactivate_user(ev) {
            ev.preventDefault();
            var userId = $(ev.currentTarget).data("user-id"); // Get the user ID

            swal({
                title: 'Deactive User',
                text: 'Are you sure you want to deactivate',
                icon: 'warning',
                buttons: true,
                dangerMode: true,
            }).then((willCancel) => {
                if (willCancel) {
                    console.log('willCanel 193', willCancel, userId);

                    performUserAction(userId, 'deactivate');
                }
            })
        }
    </script>
    <script>
        @if (session('message'))
            swal({
                icon: 'success',
                title: 'Success',
                text: `{!! session('message') !!}`,
                showConfirmButton: true, // Show "OK" button

            });
        @endif
    </script>
</body>

</html>
