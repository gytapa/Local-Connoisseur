<?php

namespace App\Http\Controllers;

use App\Models\ItrauktaVietum;
use App\Models\LankytinaVietum;
use App\Models\Sarasa;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ListsController extends Controller
{
    ///
    /// Metodas savo sąrašams matyti
    /// return - į mano sąrašų langą arba į home, jei neprisijungęs vartotojas
    ///
    public function getMyLists()
    {
        if (session_status() != PHP_SESSION_ACTIVE) {
            session_start();
        }
        if (!empty($_SESSION['user'])) {
            $lists = Sarasa::all()->where('fk_VARTOTOJASid', '=', $_SESSION['user']->id);
            return view('lists')->with('lists', $lists);
        } else
            return redirect()->route('home');

    }

    ///
    /// Metodas naujam sąrašui kurti
    /// return - sąrašo kūrimo langą arba home, jei neprisjungęs vartotojas
    ///
    public function newList()
    {
        if (session_status() != PHP_SESSION_ACTIVE) {
            session_start();
        }
        if (!empty($_SESSION['user']))
            return view('newList');
        else
            return redirect()->route('home');
    }

    ///
    /// Naujo sąrašo išsaugojimas
    /// request - sąrašo duomenys
    /// return - į mano sąrašų langą arba į home, jei neprisijungęs
    ///
    public function submitNewList(Request $request)
    {
        if (session_status() != PHP_SESSION_ACTIVE) {
            session_start();
        }
        if (!empty($_SESSION['user']) && !empty($request)) {
            $this->validate($request, [
                'title' => 'required',
                'description' => 'required'
            ]);

            $newList = new Sarasa();
            $newList->pavadinimas = $request->input('title');
            $newList->aprasymas = $request->input('description');
            $newList->fk_VARTOTOJASid = $_SESSION['user']->id;
            $newList->sukurimo_data = date('Y-m-d H:i:s');
            $newList->save();
            $_SESSION['success'] = "List was succesfully created.";
            return redirect('lists');
        } else {
            return redirect()->route('home');
        }
    }

    ///
    /// Sąrašo informacijos peržiūros metodas
    /// lid - sąrašo id
    /// return - sąrašo informacijos langą, home - jei neprisijunges ir sąrašų langą, jei bando patekti ne į savo sąrašą
    ///
    public function getInfoOfList($lid)
    {
        if (session_status() != PHP_SESSION_ACTIVE) {
            session_start();
        }
        if (!empty($_SESSION['user'])) {
            $list = Sarasa::all()->where('id', '=', $lid)->first();
            if ($list->fk_VARTOTOJASid == $_SESSION['user']->id)
                return view('infoOfList', ['list' => $list]);
            else
                return redirect('lists');
        } else
            return redirect()->route('home');
    }

    ///
    /// Vietos pridėjimo į sąrašą metodas
    /// pid - vietos id
    /// return - pridėjimo formą arba home jei vartotojas neprisijungęs
    ///
    public function addToList($pid)
    {
        if (session_status() != PHP_SESSION_ACTIVE) {
            session_start();
        }
        if (isset($_SESSION['user'])) {
            $place = LankytinaVietum::find($pid);
            $lists = Sarasa::all()->where('fk_VARTOTOJASid', $_SESSION['user']->id);
            return view('addToList', ['place' => $place, 'lists' => $lists]);
        } else
            return redirect()->route('home');
    }

    ///
    /// Vietos pridėjimo į sąrašą išsaugojimas
    /// request - vietos pridėjimo duomenys
    /// return - sąrašo į kurį pridėta langą, home - jei vartotojas neprisijungęs arba į sąrašų langą, jei bando pridėt ne į savo
    ///
    public function add(Request $request)
    {
        if (session_status() != PHP_SESSION_ACTIVE) {
            session_start();
        }
        if (isset($_SESSION['user'])) {
            $this->validate($request, [
                'list' => 'required',
                'description' => 'required'
            ]);
            $list = Sarasa::find($request->input('list'));
            if ($list->fk_VARTOTOJASid == $_SESSION['user']->id) {
                if (ItrauktaVietum::all()->where('fk_SARASASid', $request->input('list'))->where('fk_LANKYTINA_VIETAid', $request->input('pid'))->count() == 0) {
                    $addPlace = new ItrauktaVietum();
                    $addPlace->aprasymas = $request->input('description');
                    $addPlace->fk_SARASASid = $request->input('list');
                    $addPlace->fk_LANKYTINA_VIETAid = $request->input('pid');
                    $addPlace->save();
                    $_SESSION['success'] = "place was succesfully added.";
                    return redirect('/lists/infoOfList/' . $request->input('list'));
                }
            }
            else{
                return redirect('lists');
            }
        } else
            return redirect()->route('home');
    }

    ///
    /// Ištrinti vietą iš sąrašo metodas
    /// id -> pridėtos vietos elemento id
    /// return - sąrašo informacijos langą, home - jei neprisijungęs arba trina ne savo
    ///
    public function deleteAddedPlace($id)
    {
        if (session_status() != PHP_SESSION_ACTIVE) {
            session_start();
        }
        if (isset($_SESSION['user'])) {
            $addedPlace = ItrauktaVietum::find($id);
            $lid = $addedPlace['fk_SARASASid'];
            $list = Sarasa::find($lid);
            if ($list['fk_VARTOTOJASid'] == $_SESSION['user']->id) {
                ItrauktaVietum::destroy($addedPlace->id);
                $_SESSION['success'] = "Place was succesfully deleted.";
                return redirect('/lists/infoOfList/' . $list->id);
            } else {
                return redirect()->route('home');
            }
        } else
            return redirect()->route('home');
    }

    ///
    /// Pakeisti pridėtos vietos aprašymą
    /// id - pridėtos vietos elemento id
    /// return - keitimo formą, arba home jei neprisijungęs arba keičia ne savo
    ///
    public function editAddedPlace($id)
    {
        if (session_status() != PHP_SESSION_ACTIVE) {
            session_start();
        }
        if (isset($_SESSION['user'])) {
            $addedPlace = ItrauktaVietum::find($id);
            $lid = $addedPlace['fk_SARASASid'];
            $list = Sarasa::find($lid);
            if ($list['fk_VARTOTOJASid'] == $_SESSION['user']->id) {
                return view('editAddPlace', ['addedPlace' => $addedPlace]);
            } else
                return redirect()->route('home');
        } else
            return redirect()->route('home');

    }

    ///
    /// Išsaugo naują pridėtos vietos aprašymą
    /// request - nauji pridėtos vietos duomenys
    /// return - sąrašo informacijso langą arba home, jei neprisijungęs ar keičia ne savo
    ///
    public function submitNewPlaceDesc(Request $request)
    {
        if (session_status() != PHP_SESSION_ACTIVE) {
            session_start();
        }
        if (isset($_SESSION['user'])) {
            $this->validate($request, [
                'description' => 'required'
            ]);
            $addedPlace = ItrauktaVietum::find($request->input('id'));
            $lid = $addedPlace['fk_SARASASid'];
            $list = Sarasa::find($lid);
            if ($list['fk_VARTOTOJASid'] == $_SESSION['user']->id) {
                $addedPlace->aprasymas = $request->input('description');
                $addedPlace->save();
                $_SESSION['success'] = "Place was succesfully edited.";
                return redirect('/lists/infoOfList/' . $list->id);
            } else
                return redirect()->route('home');
        } else
            return redirect()->route('home');
    }


    ///
    /// Metodas sąrašui ištrinti
    /// id - sąrašo id
    /// return - sąrašų langą arba home, jei neprisijungęs vartotojas arba trina ne savo
    ///
    public function deleteList($id)
    {
        if (session_status() != PHP_SESSION_ACTIVE) {
            session_start();
        }
        if (isset($_SESSION['user'])) {
            $list = Sarasa::find($id);
            if ($list['fk_VARTOTOJASid'] == $_SESSION['user']->id) {
                $addedPlaces = ItrauktaVietum::all()->where('fk_SARASASid', $id);
                foreach ($addedPlaces as $addedPlace) {
                    ItrauktaVietum::destroy($addedPlace->id);
                }
                Sarasa::destroy($id);
                $_SESSION['success'] = "List was succesfully deleted.";
                return redirect('lists');
            } else
                return redirect()->route('home');
        } else
            return redirect()->route('home');
    }
}
