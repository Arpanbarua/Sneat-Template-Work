@extends('backend.layout');
@push('backend_css')
    {{-- for select2 --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    {{-- summernote --}}
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote.min.css" rel="stylesheet">

    <style>
        .select2-container--default .select2-selection--single {
            background-color: #fff;
            border: 1px solid #d9dee3;
            border-radius: 4px;
            height: 58px;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            color: #444;
            line-height: 55px;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            top: 16px;
        }
    </style>
@endpush

@section('backend_content')
    <div class="card-header d-flex align-items-center justify-content-between">
        <h4 class="card-title mb-0">Add Product</h4>
        <a href="#" class="btn btn-primary">Show All Products</a>
    </div>
    <div class="card-body">
        <form action="{{ route('dashboard.product.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row gx-3">
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="title" class="form-label">Product Title</label>
                        <input type="text" name="title" id="title" class="form-control p-3" placeholder="Title">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mb-3">

                        <label for="category_id" class="form-label">Category ID</label>
                        <select class="js-example-basic-single form-control p-3" name="category_id" id="category_id">
                            {{-- <option value="AL">Alabama</option>
                            ...
                            <option value="WY">Wyoming</option> --}}
                            <option value="" selected disabled> ---  Select  --- </option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->title }}</option>
                            @endforeach
                        </select>

                    </div>
                </div>

            </div>
            <div class="row gx-3">
                
                <div class="col-lg-3">
                    <div class="mb-3">
                        <label for="is_stock" class="form-label">Stock</label>
                        <select class="form-select p-3" aria-label="Large select example" id="is_stock" name="is_stock">
                            <option selected disabled> --- Select --- </option>
                            <option value="1">In stock</option>
                            <option value="0">Unavailable</option>

                        </select>
                    </div>

                </div>

                <div class="col-lg-3">
                    <div class="mb-3">
                        <label for="status" class="form-label">status</label>
                        <select class="form-select p-3" aria-label="Large select example" name="status">
                            <option selected disabled> --- Select --- </option>
                            <option value="1">Active</option>
                            <option value="0">inactive</option>

                        </select>
                    </div>

                </div>

                 <div class="col-lg-3">
                    <div class="mb-3">
                        <label for="price" class="form-label">Product Price</label>
                        <input type="number" name="price" id="price" class="form-control p-3"
                            placeholder="e.g. 34.99">
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="mb-3">
                        <label for="disc_price" class="form-label">Discount</label>
                        <input type="number" name="disc_price" id="disc_price" class="form-control p-3"
                            placeholder="e.g. 34.99">
                    </div>

                </div>

            </div>


            <div class="row gx-3">


                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="description" class="form-label">Product Description</label> <br>
                        <textarea id="summernote1" name="description" cols="20" rows="4"></textarea>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="features" class="form-label">Product Features</label> <br>
                        <textarea id="summernote2" name="features" cols="20" rows="4"></textarea>
                    </div>
                </div>

            </div>



            <button type="submit" class="btn btn-primary w-25 mt-3">Submit</button>

        </form>
    </div>
@endsection

@push('backend_js')
    
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.js-example-basic-single').select2();
        });

        $(document).ready(function() {
            $('#summernote1').summernote({
                tabsize: 2,
                height: 100
            });
        });

         $(document).ready(function() {
            $('#summernote2').summernote({
                tabsize: 2,
                height: 100
            });
        });
    </script>
@endpush

{{-- 01:01:17 --}}
