@push('backend_css')
    <style>
         .icons_align
         {
            display: inline-flex;
            align-items: center;
            line-height: 0;
         }
    </style>
@endpush

@extends('backend.layout');
@section('backend_content')
    <div class="card-header d-flex justify-content-between align-items-center">
        <h4 class="card-title mb-0">Show categories</h4>
        <a href="{{ route('dashboard.category.index') }}" class="btn btn-primary">Add New Category</a>
    </div>

    <div class="card-body table-responsive">
        <table class="table table-hover table-striped table-bordered">
            <tr class="text-center">
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
                    <td>
                        @if ($category->parent)
                         {{ $category->parent->title }}   
                        @else
                            <span class="badge text-bg-danger bg-danger">Not found</span>
                        @endif
                        
                    </td>
                    <td>
                        <div class="d-flex align-items-center">
                            <a href="{{ route('dashboard.category.edit', $category->id) }}" class="btn btn-sm btn-success">
                                <span class="icons_align"><iconify-icon icon="flowbite:edit-outline" width="24" height="24"></iconify-icon></span>
                            </a>
                            <a href="{{ route('dashboard.category.delete', $category->id) }}" class="btn btn-sm btn-danger ms-1">
                                <span class="icons_align"><iconify-icon icon="ic:sharp-delete" width="24" height="24"></iconify-icon></span>
                            </a>
                        </div>
                    </td>
                    
                
            </tr>
                @empty
                 <tr>
                    <td colspan="8">
                        <span class="alert alert-danger text-center d-block">No Category Found</span>
                        
                    </td>
                </tr>   
            @endforelse
        </table>
    </div>
@endsection