<?php

namespace App\Http\Controllers;

use App\Models\Sertifikata;
use App\Models\User;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Location;

class UserDataController extends Controller
{

    //displaying users data if he is logged in.
    //if no user is logged in its redirecting back to home page
    protected function displayUserData(Request $request)
    {
        if (session_status() != PHP_SESSION_ACTIVE) {
            session_start();
        }
        if (!isset($_SESSION['user'])) {
            return redirect()->route('home');
        } else {
            if($_SESSION['user']->role == 1){
                $certification = Sertifikata::all()->where('fk_VARTOTOJASid', $_SESSION['user']->id);
                return view('userpage')->with(["user" => $_SESSION['user'], "certification" => $certification]);
            }
            return view('userpage')->with(["user" => $_SESSION['user']]);
        }
    }

    //confirming critics so that they would be able to to do critic-specific tasks
    protected function confirmUsers()
    {
        if (session_status() != PHP_SESSION_ACTIVE) {
            session_start();
        }
        if ($_SESSION['user']->role != 0)
            return redirect()->route('home');
        $users = User::where('role', 1)->where('ar_patvirtinta', 0)->get();
        return view('confirmusers')->with(['users' => $users]);
    }

    protected function confirmUser($uid)
    {
        if (session_status() != PHP_SESSION_ACTIVE) {
            session_start();
        }
        if ($_SESSION['user']->role != 0)
            return redirect()->route('home');
        $toConfirm = User::find($uid);
        $toConfirm->ar_patvirtinta = 1;
        $toConfirm->save();
        $_SESSION['message'] = "Critic was succesfuly confirmed";
        header("Location: /confirmusers");
        $users = User::where('role', 1)->where('ar_patvirtinta', 0)->get();
        return view('confirmusers')->with(['users' => $users]);
    }

    protected function getUsersList()
    {
        if (session_status() != PHP_SESSION_ACTIVE) {
            session_start();
        }
        if ($_SESSION['user']->role != 0)
            return redirect()->route('home');
        $critics = User::where('role', '1')->get();
        $users = User::where('role', '2')->get();
        return view('userlist')->with(['users' => $users, 'critics' => $critics]);
    }

    protected function addDocument()
    {
        if (session_status() != PHP_SESSION_ACTIVE) {
            session_start();
        }
        if (isset($_SESSION['user']) && $_SESSION['user']->role == 1 && $_SESSION['user']->ar_patvirtinta == 0) {
            return view('addDocument');
        } else
            return redirect()->route('home');
    }

    protected function addDocumentSubmit(Request $request)
    {
        if (session_status() != PHP_SESSION_ACTIVE) {
            session_start();
        }
        if (isset($_SESSION['user']) && $_SESSION['user']->role == 1 && $_SESSION['user']->ar_patvirtinta == 0) {
            if ($request->hasFile('uploadedFile')) {
                $target_dir = "..\..\criticsDocuments'\'";
                $file = $request->uploadedFile;
                $target_file = $target_dir . $file->getClientOriginalName();
                if (file_exists($target_file)) {
                    $file->move(base_path('\criticsDocuments'), $file->getClientOriginalName());
                    $certification = new Sertifikata();
                    $certification->pavadinimas = $file->getClientOriginalName();
                    $certification->aprasymas = $request->input('description');
                    $certification->fk_VARTOTOJASid = $_SESSION['user']->id;
                    $certification->save();
                }
            }
            return redirect('/userpage');
        } else
            return redirect()->route('home');
    }
}


