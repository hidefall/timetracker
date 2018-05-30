<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function profile(){
        return view('user.profile');
    }

    public function saveprofile(Request $request){
        $request->validate([
            'firstname'=>'string|required',
            'lastname'=>'string|required'
        ]);

        $profile = Auth::user()->profile;
        $profile->firstname = $request->firstname;
        $profile->lastname = $request->lastname;
        $profile->phone = $request->phone;
        if($profile->save()){
            \Session::flash('success','Profile has been updated');
            return redirect()->back();
        }
    }

    public function password(){
        return view('user.password');
    }

    public function savepassword(Request $request){
        $request->validate([
            'password'=>'required|confirmed'
        ]);
        $user = Auth::user();
        $user->password = bcrypt($request->password);
        if($user->save()){
            \Session::flash('success','Password updated');
            return redirect('/user/password');
        }
    }

    public function savephoto(Request $request){
        $request->validate(['file'=>'required']);
        $image = explode(',',$request->input('file'))[1];
        $fileName = time()."-".auth()->user()->id.'.png';
        Storage::disk('public')->put($fileName,base64_decode($image));

        $profile = auth()->user()->profile;

        $profile->image = storage_path('/app/public/'.$fileName);
        if($profile->save()){
            if(unlink(storage_path('/app/public/'.$fileName))) {
                return $profile;
            }
        }
    }

}







