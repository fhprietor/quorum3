<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Weight;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class UserController extends Controller
{
    public function index()
    {
        $users = User::where('role','VOTER')
            ->orderBy('email','ASC')
            ->get();
        return view('users', ['users' =>$users]);
    }
    public function weights()
    {
        $weights = Weight::with('user')
            ->orderBy('email','ASC')
            ->get();
        return view('weights',['weights' => $weights]);
    }

}
