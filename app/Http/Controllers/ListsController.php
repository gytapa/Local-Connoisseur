<?php

namespace App\Http\Controllers;

use App\Models\ItrauktaVietum;
use App\Models\LankytinaVietum;
use App\Models\Sarasa;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ListsController extends Controller
{
    public function getMyLists()
    {
        session_start();
        if (!empty($_SESSION['user'])) {
            $lists = Sarasa::all()->where('fk_VARTOTOJASid', '=', $_SESSION['user']->id);
            return view('lists')->with('lists', $lists);
        }
    }

    public function newList()
    {
        session_start();
        return view('newList');
    }

    public function submitNewList(Request $request)
    {
        session_start();
        if (!empty($_SESSION['user'])) {
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
        }
        return redirect('lists');
    }

    public function getInfoOfList($lid)
    {
        session_start();
        $list = Sarasa::all()->where('id', '=', $lid)->first();
        return view('infoOfList', ['list' => $list]);
    }

    public function addToList($pid)
    {
        session_start();
        if (isset($_SESSION['user'])) {
            $place = LankytinaVietum::find($pid);
            $lists = Sarasa::all()->where('fk_VARTOTOJASid', $_SESSION['user']->id);
            return view('addToList', ['place' => $place, 'lists' => $lists]);
        } else
            return redirect()->route('home');
    }

    public function add(Request $request)
    {
        session_start();
        if (isset($_SESSION['user'])) {
            $list = Sarasa::find($request->input('list'));
            if (ItrauktaVietum::all()->where('fk_SARASASid', $request->input('list'))->where('fk_LANKYTINA_VIETAid', $request->input('pid'))->count() == 0) {
                $addPlace = new ItrauktaVietum();
                $addPlace->aprasymas = $request->input('description');
                $addPlace->fk_SARASASid = $request->input('list');
                $addPlace->fk_LANKYTINA_VIETAid = $request->input('pid');
                $addPlace->save();
            }
            return redirect('/lists/infoOfList/' . $request->input('list'));
        } else
            return redirect()->route('home');
    }

    public function deleteAddedPlace($id)
    {
        session_start();
        if (isset($_SESSION['user'])) {
            $addedPlace = ItrauktaVietum::find($id);
            $lid = $addedPlace['fk_SARASASid'];
            $list = Sarasa::find($lid);
            if ($list['fk_VARTOTOJASid'] == $_SESSION['user']->id) {
                ItrauktaVietum::destroy($addedPlace->id);
                return redirect('/lists/infoOfList/' . $list->id);
            } else {
                return redirect()->route('home');
            }
        } else
            return redirect()->route('home');
    }

    public function editAddedPlace($id)
    {
        session_start();
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

    public function submitNewPlaceDesc(Request $request)
    {
        session_start();
        if (isset($_SESSION['user'])) {
            $addedPlace = ItrauktaVietum::find($request->input('id'));
            $lid = $addedPlace['fk_SARASASid'];
            $list = Sarasa::find($lid);
            if ($list['fk_VARTOTOJASid'] == $_SESSION['user']->id) {
                $addedPlace->aprasymas = $request->input('description');
                $addedPlace->save();
                return redirect('/lists/infoOfList/' . $list->id);
            } else
                return redirect()->route('home');
        } else
            return redirect()->route('home');
    }

    public function deleteList($id)
    {
        session_start();
        if (isset($_SESSION['user'])) {
            $list = Sarasa::find($id);
            if ($list['fk_VARTOTOJASid'] == $_SESSION['user']->id) {
                $addedPlaces = ItrauktaVietum::all()->where('fk_SARASASid', $id);
                foreach ($addedPlaces as $addedPlace) {
                    ItrauktaVietum::destroy($addedPlace->id);
                }
                Sarasa::destroy($id);
                return redirect('lists');
            } else
                return redirect()->route('home');
        } else
            return redirect()->route('home');
    }
}
