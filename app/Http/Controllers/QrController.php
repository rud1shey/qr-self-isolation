<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;

class QrController extends Controller
{
    public function index(){
        $user = new User();
        $user->name = "1231231";
        $user->save();
        return view("home");
    }
}
