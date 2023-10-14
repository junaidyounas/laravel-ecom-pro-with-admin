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
                    {{-- Add Product Module --}}
                    <div class="col-md-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Add Product</h4>
                                <p class="card-description"> Fill the form to add product </p>
                                <form class="forms-sample" 
                                action="{{ url('/confirm_update_product', $product->id) }}"
                                enctype="multipart/form-data"
                                method="POST"
                                    >
                                    @csrf
                                    <div class="form-group">
                                        <label for="exampleInputUsername1">Title*</label>
                                        <input type="text" name="title" class="form-control"
                                            id="exampleInputUsername1" placeholder="category"
                                            value="{{ $product->title }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputUsername1">Description</label>
                                        <input type="text" name="description" class="form-control"
                                            id="exampleInputUsername1" placeholder="Description"
                                            value="{{ $product->description }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputUsername1">Price*</label>
                                        <input type="number" name="price" class="form-control"
                                            id="exampleInputUsername1" placeholder="" value="{{ $product->price }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputUsername1">Quantity</label>
                                        <input type="number" name="Quantity" class="form-control"
                                            id="exampleInputUsername1" placeholder="" value="{{ $product->quantity }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputUsername1">Discount Price</label>
                                        <input type="text" name="dicount_price" class="form-control"
                                            id="exampleInputUsername1" placeholder=""
                                            value="{{ $product->dicount_price }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleSelectGender">Gender</label>
                                        <select value="{{ $product->category }}" name="category" class="form-control"
                                            id="exampleSelectGender">
                                            @foreach ($category as $category)
                                                <option value="{{ $category->category_name }}">
                                                    {{ $category->category_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>File upload</label>
                                        <input type="file" name="images" class="file-upload-default">
                                        <div class="input-group col-xs-12">
                                            <input type="text" class="form-control file-upload-info" disabled
                                                placeholder="Upload Image">
                                            <span class="input-group-append">
                                                <button class="file-upload-browse btn btn-primary"
                                                    type="button">Upload</button>
                                            </span>
                                        </div>
                                        <img src="product/{{ $product->images }}" />
                                    </div>
                                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    {{-- Add Product module ends --}}

                </div>


            </div>
            <!-- main-panel ends -->

        </div>

        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    @include('admin.script')
    <!-- End custom js for this page -->
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
