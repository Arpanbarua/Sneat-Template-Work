@extends('backend.layout');
@push('backend_css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        .select2-container {
            box-sizing: border-box;
            display: inline-block;
            margin: 0;
            position: relative;
            vertical-align: middle;
            border-color: red !important;
            height: 55px;
        }


        .select2-container--default .select2-selection--single {
            height: 100%;
            display: flex;
            align-items: center;
            margin-top: -22px;
        }

        .select2-container--default .select2-selection--single {
            background-color: #fff;
            border: 1px solid #d9dee3;
            border-radius: 4px;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            top: -7px;
        }
    </style>
@endpush
@section('backend_content')
    <div class="card-header d-flex justify-content-between align-items-center">
        <h4 class="card-title mb-0">Add Category</h4>
        <a href="{{ route('dashboard.category.show') }}" class="btn btn-primary">Show All</a>
    </div>

    <div class="card-body">
        <form action="{{ route('dashboard.category.store') }}" method="post" enctype="multipart/form-data">

            @csrf

            <div class="row align-items-center mb-2">
                <div class="col-lg-6 mb-2">
                    <label for="title">Title <span class="text-danger">*</span></label>
                    <input type="text" name="title" id="title" class="form-control mt-2 mb-3 p-3"
                        placeholder="title">
                    @error('title')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>



                <div class="col-lg-6 ">

                    <label for="category" class="mb-4">Category Selection</label>
                    <select class="js-example-basic-single form-select p-2 " name="category" id="category">
                        <option value="" selected disabled>-- Select --</option>
                        @foreach ($allCategory as $category)
                            <option value="{{ $category->id }}">{{ $category->title }}</option>
                        @endforeach
                    </select>
                </div>


                <div class="row align-items-center">
                    <div class="col-lg-4">
                        <label for="status">Status</label>
                        <select name="status" id="status" class="form-control mt-2 p-3">
                            <option value="" selected disabled>
                                -- Select Status --
                            </option>
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>

                        @error('status')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="col-lg-4">
                        <label for="m_title">Meta Title</label>
                        <input type="text" name="m_title" id="m_title" class="form-control p-3 mt-2"
                            placeholder="Meta Title">
                    </div>

                    <div class="col-lg-4">
                        <label for="m_desc">Meta description</label>
                        {{-- <input type="text" name="m_desc" id="m_desc" class="form-control p-3 mt-2" placeholder="Meta Description"> --}}
                        <textarea name="m_desc" id="" cols="3" rows="2" class="form-control mt-1" placeholder="Write Meta Description Here"></textarea>
                    </div>


                </div>

                <div class="row align-items-end g-2">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="m_img" class="form-label">Choose Image</label>
                            <input type="file" name="m_img" id="m_img" class="form-control p-2">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <button type="submit" class="btn btn-primary w-100 p-2">Submit</button>
                    </div>
                </div>








            </div>



        </form>
    </div>
@endsection

@push('backend_js')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.js-example-basic-single').select2();
        });
    </script>
@endpush


