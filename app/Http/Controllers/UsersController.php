<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UsersController extends Controller
{
    //
    public function index()
    {
        $users = User::all();
        return view ('users/users', [
            'users' => $users,
        ]);
    }

    //its working if the url will use unique field from the DB !!!!!
    //to see the frendly url instead of just id we need to go to  User class
    //and  overwrite the Model class method "getRouteKey" 
    public function show(User $user)
    {
        //dd($user);
        return $user;
         
    }
}
