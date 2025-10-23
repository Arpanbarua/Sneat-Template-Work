@extends('backend.layout');


@section('backend_content')
    <div class="card-header d-flex align-items-center justify-content-between">
        <h4 class="card-title mb-0">Show Products</h4>
        <a href="#" class="btn btn-primary">Add Products</a>
    </div>
    <div class="card-body table-responsive">
        <div class="row">
            <div class="col-12 table-responsive">
                <table class="table table-bordered table-striped mt-3">
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Slug</th>
                        <th>Price</th>
                        <th>Discount Price</th>
                        <th>is_stock</th>
                        <th>Status</th>
                        <th>Description</th>
                        <th>Features</th>
                        <th>Action</th>
                    </tr>

                    @forelse ($products as $key=>$product)
                        <tr>
                            <td>{{ ++$key }}</td>
                            <td>{{ $product->title }}</td>
                            <td>{{ $product->slug }}</td>
                            <td>{{ $product->price }}</td>
                            <td>{{ $product->disc_price ? $product->disc_price : '--' }}</td>

                            <td>
                                @if ($product->is_stock==1)
                                    <span class="badge text-bg-success bg-success">In Stock</span>
                                @else
                                    <span class="badge text-bg-danger bg-danger">Unavailable</span>
                                @endif
                            </td>

                            <td>
                                 @if ($product->status==1)
                                    <span class="badge text-bg-success bg-success">Active</span>
                                @else
                                    <span class="badge text-bg-danger bg-danger">Inactive</span>
                                @endif
                            </td>
                            {{-- <td>{{ !! $product->description  !! }}</td>
                            <td>{{ !! $product->features !! }}</td> --}}
                            <td>{{!!  $product->description ?? '--'  !!}}</td>
                            <td>{{!!  $product->features ?? '--'  !!}}</td>
                            <td>
                                <div class="d-flex">
                                <a href="#" class="btn btn-sm btn-success">Edit</a>
                                <a href="#" class="btn btn-sm btn-danger ms-2">Delete</a>
                                </div>
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
                {{ $products->links() }}
            </div>
        </div>
    </div>
@endsection
