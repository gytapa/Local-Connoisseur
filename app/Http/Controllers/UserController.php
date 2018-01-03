<?php

namespace App\Http\Controllers;

use App\Models\Blokuoti;
use App\Models\User;
use Illuminate\Contracts\Validation\Factory;
use Illuminate\Foundation\Http\Middleware\ValidatePostSize;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Validator;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(Request $request)
    {
        if (session_status() != PHP_SESSION_ACTIVE) {
            session_start();
        }
     /*  $data->validate([
            'vardas' => $data['name'],
            'pavarde' => $data['lastname'],
            'el_pastas' => $data['email'],
            'slaptazodis' => bcrypt($data['password']),
            'miestas' => $data['city'],
            'adresas' => $data['address'],
            'ar_patvirtinta' => 0,
            'role' => 1
        ]);*/
     //checking if data that user has inputted is correct.
        $this->checkForEmail($request['email']);
        //validating data:checking if enetered data is valid
        if ($this->checkForEmail($request['email'])) {
            $validator = Validator::make(
                [
                    'firstname' => $request['firstname'],
                    'lastname' => $request['lastname'],
                    'password1' => $request['password1'],
                    'password2' => $request['password2'],
                    'city' => $request['city'],
                    'address' => $request['address'],
                    'email' => $request['email']
                ],
                [
                    'firstname' => 'required',
                    'lastname' => 'required',
                    'password1' => 'required',
                    'password2' => 'required|same:password1',
                    'city' => 'required',
                    'address' => 'required',
                    'email' => 'required|email'
                ]
            );
            if ($validator->fails()) {
                //error during validation, show user the mistakes
                $errors = $validator->failed();
                return view("register")->with(["errors" => $errors]);
            }

            //if validation is correct, we can insert user to database
            $user = new User;

            $user->pavarde = $request['lastname'];
            $user->vardas = $request['firstname'];
            $user->adresas = $request['address'];
            $user->ar_patvirtinta = false;
            $user->el_pastas = $request['email'];
            $user->miestas = $request['city'];
            $user->role = $request['type'];
            $user->slaptazodis = Hash::make($request['password1']);
            $user->save();

            return view("registered");
        }
        else
            return view("register")->with(['yra' =>"This email is already in use"]);

    }

    //tries to log the user in
    protected function login(Request $request)
    {
        session_start();
        //checks if there is user with this email
        if (isset($_SESSION['user'])) {
            return redirect()->route('home');
        }
        if (!($this->checkForEmail($request['email'])))
        {
            $user = User::where('el_pastas',$request['email'])->first();
            $block = Blokuoti::all()->where('fk_VARTOTOJASid', $user->id)->first();
            if(count($block) == 0 || strtotime($block->laikas) < strtotime('now')) {
                if(count($block) > 0 && strtotime($block->laikas) < strtotime('now')){
                    Blokuoti::destroy($block->id);
                }
                //tries to confirm password
                if (Hash::check($request['password'], $user->slaptazodis)) {
                    //user has entered correct data. put his data to session.
                    $request->session()->put('user', $user);
                    $_SESSION['user'] = $user;
                    return view('loggedin');
                } else
                    return view('login')->with(['password' => "Bad password"]);
            }
            else{
                $block = Blokuoti::all()->where('fk_VARTOTOJASid', $user->id)->first();
                return view('login')->with(['block' => $block]);
            }
        }
        return view('login')->with(['email' => "Entered email is not in our database"]);
    }
//logs the user out of the system
    protected function logout()
    {
        session_start();
        unset($_SESSION['user']);
        return redirect()->route('home');
    }

    //views login page
    protected function viewLogin()
    {
        session_start();
        if (isset($_SESSION['user'])) {
            return redirect()->route('home');
        }
        return view('login');
    }

    //views registration form
    protected function viewForm()
    {
        session_start();
        if (isset($_SESSION['user'])) {
            return redirect()->route('home');
        }
        return view("register");
    }

    //checkes if there if this email is already in the system.
    protected function checkForEmail($email)
    {

        $users = User::where('el_pastas',$email)->count();
        if ($users == 0)
            return true;
        return false;
    }

    //change password view form
    protected function changePasswordView()
    {
        session_start();
        return view("changepass")->with(['user' => $_SESSION['user']]);
    }

    //change the password of a user. if user enters all data correctly then he will chnange his password to a new one
    protected function changePassword(Request $request)
    {
        session_start();

        $message = "";
        if ((Hash::check($request['password'],$_SESSION['user']->slaptazodis)))
        {
            if (strlen($request['newpass']) >= 6) {
                if (strcmp($request['newpasss'] , $request['newpasss2']) == 0) {
                    $message = "Password has been changed";
                    $_SESSION['user']->slaptazodis = Hash::make($request['newpass']);
                    $_SESSION['user']->save();
                }
                else
                $message = "passwords do not match";
            }
            else
                $message = "new password is too short";
        }
        else
            $message = "Bad current password";
        return view("changepass")->with(['user' => $_SESSION['user'],"message" => $message]);
    }


}
