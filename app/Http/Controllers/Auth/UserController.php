<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('users', ['users' =>$users]);
    }
}
