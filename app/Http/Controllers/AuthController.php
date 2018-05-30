<?php

namespace App\Http\Controllers;

use App\Mail\WelcomeUser;
use App\Models\Company;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    public function authForm(){
        return view('auth');
    }

    public function login(Request $request){
        $request->validate([
           'email'=>'required|email',
           'password'=>'required'
        ]);

        if(Auth::attempt(['email'=>$request->email,'password'=>$request->password])){
            return Auth::user();
        }else{
           return 0;
        }
    }

    public function register(Request $request, $role = 'user'){
        $request->validate([
            'firstname'=>'required|string',
            'lastname'=>'required|string',
            'email'=>'required|email',
            'password'=>'required|confirmed|min:6'
        ]);

        $user = User::firstOrCreate([
            'email'=>$request->email,
        ],
        [
            'email'=>$request->email,
            'password'=>bcrypt($request->password),
            'role'=>$role
        ]);
        if($user){
            $profile = Profile::create([
                'firstname'=>$request->firstname,
                'lastname'=>$request->lastname,
                'user_id'=>$user->id
            ]);
            if($profile){
               Mail::to($user->email)->send(new WelcomeUser($request->firstname,$request->lastname));
               return $this->login($request);
            }else{
                if(User::destroy($user->id)){
                    return 0;
                }
            }
        }
    }

    public function registerCompany(Request $request){

        if($this->register($request, 'company')){
            $request->validate([
                'company_name'=>'required|string',
                'company_number'=>'required|string'
            ]);

            $company = Company::create([
                'name'=>$request->company_name,
                'number'=>$request->company_number
            ]);

            $company->user()->attach(Auth::user());

            if($company){
                return ["company"=>$company, "user"=>$company->user];
            }
        }
    }
}









