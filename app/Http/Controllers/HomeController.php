<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    //shows the index page of website
    public function index()
    {
        session_start();
        return view('home');
    }

    ///
    /// Metodas about langui atidaryti
    /// return - about langą
    ///
    public function about(){
        if (session_status() != PHP_SESSION_ACTIVE) {
            session_start();
        }
        return view('about');
    }

    ///Metodas contact langui atidaryti
    ///return contact langą
    ///
    public function contact(){
        if (session_status() != PHP_SESSION_ACTIVE) {
            session_start();
        }
        return view('contact');
    }
}
