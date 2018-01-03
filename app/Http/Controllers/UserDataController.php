<?php

namespace App\Http\Controllers;

use App\Models\Blokuoti;
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

    ///
    /// Kirtiko patvirtinimo išsaugojimas
    /// uid - vartotojo id
    /// return - langą su kritikais dar laukiančiais patvirtinimo, arba home, jei ne admin
    ///
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
        $_SESSION['success'] = "Critic was succesfuly confirmed";
        header("Location: /confirmusers");
        $users = User::where('role', 1)->where('ar_patvirtinta', 0)->get();
        return view('confirmusers')->with(['users' => $users]);
    }

    ///
    /// Metodas sistemos vartotojams gauti
    /// return - sistemos vartotojų langą arba home jei neprisijungęs
    ///
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

    ///
    /// Metodas dokumentams įkelti
    /// return - dokumento įkėlimo langą, arba home jei nepraeina autorizacijos
    ///
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

    ///
    /// Dokuemnto išsaugojimas
    /// request - failas ir jo informacija
    /// return - userpage arba home, jei neprisijungęs
    ///
    protected function addDocumentSubmit(Request $request)
    {
        if (session_status() != PHP_SESSION_ACTIVE) {
            session_start();
        }
        if (isset($_SESSION['user']) && $_SESSION['user']->role == 1 && $_SESSION['user']->ar_patvirtinta == 0) {
            $this->validate($request, [
                'file' => 'required',
                'description' => 'required'
            ]);
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

    ///
    /// Metodas dokumentui atsisiųsti
    /// name - failo pavadinimas
    /// return - userpage
    ///
    protected function downloadDocument($name){
        if (session_status() != PHP_SESSION_ACTIVE) {
            session_start();
        }
        if(isset($_SESSION['user']) && $_SESSION['user']-> role != 2) {
            $doc = Sertifikata::all()->where('pavadinimas', $name)->first();
            if($doc->fk_VARTOTOJASid == $_SESSION['user']->id ||$_SESSION['user']->role == 0) {
                $file = base_path('criticsDocuments/') . $name;
                if (file_exists($file)) {
                    header('Content-Description: File Transfer');
                    header('Content-Type: application/octet-stream');
                    header('Content-Disposition: attachment; filename="' . basename($file) . '"');
                    header('Expires: 0');
                    header('Cache-Control: must-revalidate');
                    header('Pragma: public');
                    header('Content-Length: ' . filesize($file));
                    readfile($file);
                }
            }
            return redirect('userpage');
        }
        else
            return redirect()->route('home');
    }

    ///
    /// Metodas vartotojui blokuoti
    /// id - vartotojo id
    /// return - blokavimo formą, arba home, jei nepraeina autentifikacijos
    ///
    protected function blockUser($id){
        if (session_status() != PHP_SESSION_ACTIVE) {
            session_start();
        }
        if(isset($_SESSION['user']) && $_SESSION['user']->role == 0) {
            $user = User::all()->where('id', $id)->first();
            return view('blockUser')->with(['user' => $user]);
        }
        else
            return redirect()->route('home');
    }

    protected function submitBlock(Request $request){
        if (session_status() != PHP_SESSION_ACTIVE) {
            session_start();
        }
        if(isset($_SESSION['user']) && $_SESSION['user']->role == 0) {
            $this->validate($request, [
                'reason' => 'required',
                'date' => 'required'
            ]);
            $blocks = Blokuoti::all()->where('fk_VARTOTOJASid', $request->input('id'));
            foreach ($blocks as $item){
                Blokuoti::destroy($item->id);
            }
            $block = new Blokuoti();
            $block->priezastis = $request->input('reason');
            $block->laikas = $request->input('date');
            $block->fk_VARTOTOJASid = $request->input('id');
            $block->save();
            $_SESSION['success'] = "User was succesfully blocked.";
            return redirect('userslist');
        }
        else
            return redirect()->route('home');
    }

    ///
    /// Metodas vartotojui atblokuoti
    /// id - vartotojo id
    /// return - varotojų sąrašą arba home, jei nepraeina autentifikacijos
    protected function unblock($id){
        if (session_status() != PHP_SESSION_ACTIVE) {
            session_start();
        }
        if(isset($_SESSION['user']) && $_SESSION['user']->role == 0) {
            $blocks = Blokuoti::all()->where('fk_VARTOTOJASid', $id);
            foreach ($blocks as $item){
                Blokuoti::destroy($item->id);
            }
            $_SESSION['success'] = "User was succesfully unblocked.";
            return redirect('userslist');
        }
        else
            return redirect()->route('home');
    }
}


