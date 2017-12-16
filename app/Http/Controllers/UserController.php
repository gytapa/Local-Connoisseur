<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Validation\Factory;
use Illuminate\Foundation\Http\Middleware\ValidatePostSize;
use Illuminate\Http\Request;
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
            $user->role = 0;
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
        //checks if there is user with this email
        if (!($this->checkForEmail($request['email'])))
        {
            $user = User::where('el_pastas',$request['email'])->first();
            //tries to confirm password
            if (Hash::check($request['password'], $user->slaptazodis)) {
                //user has entered correct data. put his data to session.
                $_SESSION['user'] = $user;
                return view('loggedin');
            }
            else
            return view('login')->with(['password' => "Bad password"]);
        }
        return view('login')->with(['email' => "Entered email is not in our database"]);

    }

    //views login page
    protected function viewLogin()
    {
        return view('login');
    }

    protected function viewForm()
    {

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
}