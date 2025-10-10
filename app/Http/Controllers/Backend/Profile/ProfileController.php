<?php

namespace App\Http\Controllers\Backend\Profile;

use Illuminate\Http\Request;
use SweetAlert2\Laravel\Swal;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    // index
    public function index()
    {
        $authuserinfo = Auth::user(); //user table
        return view('backend.profile.index', compact('authuserinfo')); // retrieving value using compact
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email,'.Auth::user()->id,
        ],[
            'name.required' => 'The name field must be filled',
            'email.required' => 'The email field must be filled',
        ]);
        $authuserupdate = Auth::user(); //user table
        // dd($authuserupdate);
        $authuserupdate->name = $request->name;
        $authuserupdate->email = $request->email;
        $authuserupdate->save();
        Swal::success([
            'title' => 'Profile Updated Successfully!',
        ]);
        
        return back();
    }

    // password update

    public function passwordUpdate(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required',
            'confirm_password' => 'required',
        ]);

        $pwupdate = Auth::user();

        if(! Hash::check($request->current_password, $pwupdate->password))
        {
             Swal::error([
                'title' => 'Current password does not match',
            ]);
            return back();
        }

        if($request->new_password != $request->confirm_password)
        {
            Swal::error([
                'title' => 'new password and confirm password does not match',
            ]);
            
            return back();
        }
        
        $pwupdate->password = Hash::make($request->new_password); // save the hash version of the new password if it matches
        $pwupdate->save();

        Swal::success([
            'title' => 'Password Updated Successfully!',
        ]);

        return redirect()->route('dashboard');

       

        //dd(Hash::make($request->new_password), $passowrd->password);
        //dd($passowrd);
    }

    //image-update
    public function imageUpdate(Request $request)
    {
        $authUserImage = Auth::user();
        
        if($request->hasFile('imgInp'))
            {
                $image = $request->file('imgInp');
                $imgUniqueName = 'profile-' . time() .'-'. $image->getClientOriginalName();
                $image->storeAs('profile/',$imgUniqueName,'public');
                $authUserImage->image = $imgUniqueName;
                $authUserImage->save();

                Swal::success([
                    'title' => 'Image Uploaded Successfully!',
                ]);

                return redirect()->route('dashboard');
                //dd($authUserImage, $imgUniqueName);
                //dd($request->file('imgInp'));
            }
        //dd($request->all());   
    }





}

// 01:32:31