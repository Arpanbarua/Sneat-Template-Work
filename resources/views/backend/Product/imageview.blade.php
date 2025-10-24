@extends('backend.layout');
@push('backend_css')
    <style>
        .styleicon {
            display: inline-flex;
            justify-content: center;
            align-items: center;
            line-height: 0;
        }
    </style>
@endpush

@section('backend_content')
    <div class="card-header d-flex align-items-center justify-content-between">
        <h4 class="card-title mb-0">Show Images</h4>
        <a href="{{ route('dashboard.product.image.index') }}" class="btn btn-primary">Add Images</a>
    </div>
    <div class="card-body table-responsive">
        <div class="row">
            <div class="col-12 table-responsive">
                <table class="table table-striped table-bordered">
                    <tr>
                        <th>ID</th>
                        <th>Product Name</th>
                        <th>Product Image</th>
                        <th>Action</th>
                    </tr>

                    @forelse ($images as $key=>$image)
                        <tr>
                            <td>{{ ++$key }}</td>
                            <td>{{ $image->title }}</td>
                            <td>
                                @if ($image->images)
                                    
                                    @forelse ($image->images as $child)
                                        <img src="{{ asset('storage/uploads/product/'.$child->image) }}" alt="{{ $child->image }}" width="80">
                                    @empty
                                        <p class="alert alert-danger mb-0 d-inline-block ">No image found</p>
                                    @endforelse
                                                                   
                                @endif
                            </td>
                            <td>
                                <div class="d-flex">
                                <a href="#" class="btn btn-sm btn-success">
                                    <span class="styleicon"><iconify-icon icon="bxs:edit" width="24" height="24"></iconify-icon></span>    
                                </a>
                                <a href="#" class="btn btn-sm btn-danger ms-2">
                                    <span class="styleicon"><iconify-icon icon="material-symbols-light:delete-sharp" width="24" height="24"></iconify-icon></span>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="10">
                                <div class="alert alert-danger">No Product found</div>
                            </td>
                        </tr>
                    @endforelse
                </table>
                <div class="mt-5">
                    {{ $images->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection

@push('backend_js')
    <script src="https://cdn.jsdelivr.net/npm/iconify-icon@3.0.0/dist/iconify-icon.min.js"></script>
@endpush
