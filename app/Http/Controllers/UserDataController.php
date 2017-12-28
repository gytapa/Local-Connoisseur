<?php

namespace App\Http\Controllers;

use App\Models\User;
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
    //confirming critics so that they would be able to to do critic-specific tasks
    protected function confirmUsers()
    {
        session_start();
        if ($_SESSION['user']->role != 0)
            return redirect()->route('home');
        $users = User::where('role',2)->get();
        return view('confirmusers')->with(['users' => $users]);
    }

    protected function confirmUser($uid)
    {
        session_start();
        if ($_SESSION['user']->role != 0)
            return redirect()->route('home');
        $toConfirm = User::find($uid);
        $toConfirm->ar_patvirtinta = 1;
        $toConfirm->save();
        $_SESSION['message'] = "Critic was succesfuly confirmed";
        header("Location: /confirmusers");
        $users = User::where('role',2)->get();
        return view('confirmusers')->with(['users' => $users]);
    }
}


