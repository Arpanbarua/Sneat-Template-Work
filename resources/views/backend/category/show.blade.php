@extends('backend.layout');
@section('backend_content')
    <div class="card-header d-flex justify-content-between align-items-center">
        <h4 class="card-title mb-0">Show categories</h4>
        <a href="{{ route('dashboard.category.index') }}" class="btn btn-primary">Add New Category</a>
    </div>

    <div class="card-body table-responsive">
        <table class="table table-hover table-striped table-bordered">
            <tr>
                <th>Id</th>
                <th>Title</th>
                <th>Image</th>
                <th>Status</th>
                <th>Meta-Title</th>
                <th>Meta-Description</th>
                <th>Parent_id</th>
                <th>Action</th>
            </tr>
            @forelse ($categories as $key=>$category)
            <tr class="text-center">
                    <td>{{ ++$key }}</td>
                    <td>{{ $category->title }}</td>
                    <td>
                        @if ($category->image)
                            <img style="width: 60px;" src="{{ asset('/storage/category/'.$category->image)  }}" alt="">
                        @else
                             <p class="badge text-bg-danger bg-danger mb-0">No Image Found</p>
                        @endif
                           
                    </td>
                    <td>
                        @if ($category->status == 1)
                            <span class="badge text-bg-success bg-success">Active</span>
                        @else
                            <span class="badge text-bg-danger bg-danger">Inactive</span>
                        @endif
                    </td>
                    <td>{{ $category->meta_title ? $category->meta_title : '--'  }}</td>
                    <td>{{ $category->meta_description ? $category->meta_description : '--' }}</td>
                    <td></td>
                    <td>
                        <div class="d-flex align-items-center">
                            <a href="#" class="btn btn-sm btn-success">Edit</a>
                            <a href="#" class="btn btn-sm btn-danger ms-1">Delete</a>
                        </div>
                    </td>
                    
                
            </tr>
                @empty
                 <tr>
                    <td colspan="7" class="alert alert-danger">No Category Found</td>
                </tr>   
            @endforelse
        </table>
    </div>
@endsection