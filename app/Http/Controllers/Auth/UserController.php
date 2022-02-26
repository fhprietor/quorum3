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
        $count = User::where('role','VOTER')->count();
        $users = User::where('role','VOTER')
            ->orderBy('email','ASC')
            ->paginate(3);
        return view('users', ['users' =>$users, 'count' => $count]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     *
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect(route('users.index'))
            ->with('success', 'Registro borrado');
    }
}
