@extends('backend.layout');

@section('backend_content')
    <div class="card-header">
        <h3 class="card-title">Profile Update</h3>
    </div>
    <div class="card-body">
        <div class="row gx-3">
            <div class="col-lg-4">
                <div class="shadow p-3 rounded">
                    <h6 class="text-center text-primary">Basic Info</h6>
                    <hr>
                    <form action="{{ route('dashboard.profile.store') }}" method="POST" enctype="multipart/form-data">

                        @csrf

                        <div class="mb-3 mt-3">
                            <label for="name">Name</label>
                            <input type="text" name="name" id="name" placeholder="Name"
                                class="form-control mt-2 p-3" value=" {{ $authuserinfo->name }}">
                        </div>

                        @error('name')
                            <p class="alert alert-danger">{{ $message }}</p>
                        @enderror

                        <div class="mb-3 mt-2">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" placeholder="Email"
                                class="form-control mt-2 p-3" value="{{ $authuserinfo->email }}">
                        </div>

                        @error('email')
                            <p class="alert alert-danger">{{ $message }}</p>
                        @enderror

                        <button type="submit" class="btn btn-primary w-100 p-2">Update</button>

                    </form>

                </div>
            </div>

            <div class="col-lg-4 ">
                <div class="shadow p-3 rounded h-100">
                    <h6 class="text-center text-primary">Password Update</h6>
                    <hr>
                    <form action="{{ route('dashboard.password.update') }}" method="post" enctype="multipart/form-data">

                        @csrf

                        <div class="mb-3 mt-3">
                            <label for="current_password">Current Password</label>
                            <input type="password" name="current_password" id="current_password"
                                placeholder="Current Password" class="form-control mt-2 p-3" value="">
                        </div>

                        @error('current_password')
                            <p class="text-danger mb-0">{{ $message }}</p>
                        @enderror

                        <div class="mb-3 mt-3">
                            <label for="new_password">New Password</label>
                            <input type="password" name="new_password" id="new_password" placeholder="New Password"
                                class="form-control mt-2 p-3" value="">
                        </div>

                         @error('new_password')
                            <p class="text-danger mb-0">{{ $message }}</p>
                        @enderror

                        <div class="mb-3 mt-3">
                            <label for="confirm_password">Confirm Password</label>
                            <input type="password" name="confirm_password" id="confirm_password"
                                placeholder="Confirm Password" class="form-control mt-2 p-3" value="">
                        </div>

                         @error('confirm_password')
                            <p class="text-danger ">{{ $message }}</p>
                        @enderror

                        <button type="submit" class="btn btn-primary w-100">Submit</button>

                    </form>
                </div>
            </div>

             <div class="col-lg-4 ">
                <div class="shadow p-3 rounded">
                    <h6 class="text-center text-primary">Profile Image Update</h6>
                    <hr>
                    <form action="{{ route('dashboard.image.update') }}" method="post" enctype="multipart/form-data">

                        @csrf

                        <div class="mb-3 mt-3">
                            
                            <label for="imgInp">
                               <div class="text-center">
                                 <img src="{{ Auth::user()->image ? env('APP_URL') . '/storage/profile/' . Auth::user()->image  : asset('assets/img/ph_img/placeholder_img.jpg')  }}" alt="placeholder img" id="blah" class="img-fluid rounded">

                               </div>
                            </label>
                            <input accept="image/*" type="file" name="imgInp" id="imgInp" hidden class="form-control mt-2 p-3" >
                           
                            {{-- <input accept="image/*" type='file' id="imgInp" /> --}}
                            {{-- <img id="blah" src="#" alt="your image" /> --}}


                        </div>

                        {{-- @error('current_password')
                            <p class="text-danger mb-0">{{ $message }}</p>
                        @enderror --}}

                       
                        <button type="submit" class="btn btn-primary w-100">Upload Picture</button>

                    </form>
                </div>
            </div>


        </div>
    </div>
@endsection

@push('backend_js')
    <script>
        imgInp.onchange = evt => {
  const [file] = imgInp.files
  if (file) {
    blah.src = URL.createObjectURL(file)
  }
}
    </script>
@endpush


{{-- 04:59 --}}
