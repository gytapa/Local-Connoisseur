<?php

namespace App\Http\Controllers;

use App\Models\Sarasa;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ListsController extends Controller
{
    public function getMyLists(){
        session_start();
        if(!empty($_SESSION['user'])){
            $lists = Sarasa::all()->where('fk_VARTOTOJASid', '=', $_SESSION['user']->id);
            return view('lists')->with('lists', $lists);
        }
    }

    public function newList(){
        session_start();
        return view('newList');
    }

    public function submitNewList(Request $request){
        session_start();
        if(!empty($_SESSION['user'])) {
            $this->validate($request, [
                'title' => 'required',
                'description' => 'required'
            ]);
            //dar viena lentele be id :(
            $newList = new Sarasa();
            $newList->pavadinimas = $request->input('title');
            $newList->aprasymas = $request->input('description');
            $newList->fk_VARTOTOJASid =$_SESSION['user']->id;
            $newList->sukurimo_data = date('Y-m-d H:i:s');
            $newList->save();
        }
        return redirect('lists');
    }

    public function getInfoOfList(){
        session_start();
        return view('infoOfList');
    }
}
