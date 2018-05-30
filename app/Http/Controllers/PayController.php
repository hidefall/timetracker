<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class PayController extends Controller
{
    public function subscribe(Request $request){
        if($request->type) {
            $request->validate([
                '_token' => 'required',
                'plan' => 'required',
            ]);
            $subscription = auth()->user()->newSubscription('main', $request->plan)->create($request->token);
            if($subscription){
                return redirect('/dashboard');
            }
        }else{
            $request->validate([
                'user'=>'required',
                'token' => 'required',
                'plan' => 'required',
            ]);
            $user = User::find($request->user);
            $subscription = $user->newSubscription('main', $request->plan)->create($request->token);

            return $subscription;
        }
    }

    public function unsubscribe(){

    }

    public function payment(){
        return view('payment');
    }
}













