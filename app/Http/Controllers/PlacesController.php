<?php

namespace App\Http\Controllers;

use App\Models\Komentara;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\LankytinaVietum;
use APP\Models\User;
use App\Models\VietosVertinima;
use App\Models\AplankytaVietum;

class PlacesController extends Controller
{
    public function getPlaces(){
        session_start();
        $places = LankytinaVietum::all();

        return view('places')->with('places', $places);
    }

    public function getInfoOfPlace($pid){
        session_start();
        $place = LankytinaVietum::all()->where('id', '=', $pid)->first();
        $comments = Komentara::all()->Where('fk_LANKYTINA_VIETAid','=', $pid);
        return view('/infoOfPlace', ['place' => $place, 'comments' => $comments]);
    }

    public function Evaluate($pid, $evaluation){

        session_start();
        if($evaluation >= 1 || $evaluation <= 5) {
            if (!empty($_SESSION['user'])) {
                $isAlreadyEvaluated = VietosVertinima::all()->where('fk_VARTOTOJASid', '=', $_SESSION['user']->id)->where('fk_LANKYTINA_VIETAid','=', $pid)->first();
                //Jei dar nevertinta
                if (empty($isAlreadyEvaluated)) {
                    $newEvaluation = new VietosVertinima;
                    $newEvaluation->vertinimas = $evaluation;
                    $newEvaluation->fk_LANKYTINA_VIETAid = $pid;
                    $newEvaluation->fk_VARTOTOJASid = $_SESSION['user']->id;
                    $newEvaluation->save();
                }
                //Jei skirias vertinimas
                elseif ($isAlreadyEvaluated->vertinimas != $evaluation){
                       $isAlreadyEvaluated->vertinimas =$evaluation;
                       $isAlreadyEvaluated->save();

                }

            }
        }

        return redirect('infoOfPlace/'.$pid);
    }

    public function visited($pid){
        session_start();
        $place = LankytinaVietum::all()->where('id',$pid)->first();
        return view('visited')->with(['pid'=> $pid, 'name' => $place->pavadinimas]);
    }

    public function submitVisited(Request $request){
        session_start();
        if(!empty($_SESSION['user']) && date(now()) > $request->input('date')) {
            $this->validate($request, [
                'comment' => 'required'
            ]);
            //dar viena lentele be id :(
            $newVisitedPlace = new AplankytaVietum();
            $newVisitedPlace->data = $request->input('date');
            $newVisitedPlace->komentaras = $request->input('comment');
            $newVisitedPlace->fk_VARTOTOJASid =$_SESSION['user']->id;
            $newVisitedPlace->fk_LANKYTINA_VIETAid = $request->input('pid');
            $newVisitedPlace->save();
        }

        return redirect('infoOfPlace/'.$request->input('pid').'/');
    }

    public function getVisits(){
        session_start();
        if (!isset($_SESSION['user']))
        {
            return redirect()->route('home');
        }
        else{
            $visitedPlaces = AplankytaVietum::all()->where('fk_VARTOTOJASid', $_SESSION['user']->id);
            return view('visits')->with(['visitedPlaces'=> $visitedPlaces]);
        }
    }
}
