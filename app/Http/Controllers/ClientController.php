<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;


class ClientController extends Controller
{
    public function getClientsList(){
        return Client::where([['user_id','=',auth()->user()->id]])->orderBy('name','ASC')->get()->pluck('name','id');
    }
}
