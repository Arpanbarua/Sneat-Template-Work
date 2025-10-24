@extends('backend.layout')
@push('backend_css')
    {{-- filepond --}}
    <link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet" />
    {{-- for select2 --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        .select2-container--default .select2-selection--single {
            background-color: #fff;
            border: 1px solid #d9dee3;
            border-radius: 4px;
            height: 75px;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            color: #444;
            padding-left: 20px;
            line-height: 72px;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            top: 25px;
        }
    </style>
@endpush

@section('backend_content')
    <div class="card-header d-flex align-items-center justify-content-between">
        <h4 class="card-title mb-0">Add Image(s) For Products</h4>
        <a href="{{ route('dashboard.product.image.show') }}" class="btn btn-primary">Show All Images</a>
    </div>
    <div class="card-body">
        <form action="{{ route('dashboard.product.image.store') }}" method="post" enctype="multipart/form-data">
            @csrf

            <div class="row">
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="image" class="form-label">Image Upload</label>
                        <input multiple name="images[]" type="file" id="image">
                        {{-- [] for multiple images, no [] for single image upload --}}
                    </div>

                    @error('images')
                        <p class="alert alert-danger">{{ $message }}</p>
                    @enderror
                </div>

                <div class="col-lg-6">
                    <div class="mb-3">

                        <label for="product_id" class="form-label">Product ID</label>
                        <select class="js-example-basic-single form-control p-3" name="product_id" id="product_id">

                            <option value="" selected disabled> --- &nbsp;&nbsp;Select Product --- </option>
                            @foreach ($products as $product)
                                <option value="{{ $product->id }}">{{ $product->title }}</option>
                            @endforeach
                        </select>

                    </div>

                    @error('product_id')
                        <p class="alert alert-danger">{{ $message }}</p>
                    @enderror

                    <button class="btn btn-primary w-50 mt-3" type="submit">Submit</button>
                </div>


            </div>


        </form>
    </div>
@endsection

@push('backend_js')
@endpush

@push('backend_js')
    {{-- select2 --}}
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    {{-- filepond --}}
    <script src="https://unpkg.com/filepond@^4/dist/filepond.js"></script>
    <script>
        $(document).ready(function() {
            $('.js-example-basic-single').select2();
        });
        // Get a reference to the file input element
        const inputElement = document.querySelector('input[type="file"]');

        // Create a FilePond instance
        const pond = FilePond.create(inputElement,{
            storeAsFile: true,
            allowMultiple: true,
        });
    </script>
@endpush






{{-- 45:05 --}}
