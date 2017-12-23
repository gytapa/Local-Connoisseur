<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use phpDocumentor\Reflection\Location;

class UserDataController extends Controller
{

    //displaying users data if he is logged in.
    //if no user is logged in its redirecting back to home page
    protected function displayUserData(Request $request)
    {
        session_start();
        if (!isset($_SESSION['user']))
        {
            return redirect()->route('home');
        }
        else
            return view('userpage')->with(["user" => $_SESSION['user']]);
    }
}
