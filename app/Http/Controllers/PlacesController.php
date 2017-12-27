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
        if($evaluation == 1 || $evaluation ==-1) {
            if (!empty($_SESSION['user'])) {
                $isAlreadyEvaluated = VietosVertinima::all()->where('fk_VARTOTOJASid', '=', $_SESSION['user']->id)->where('fk_LANKYTINA_VIETAid','=', $pid)->first();

                //Didesnio sudo uz sita, kur praso id nemates
                //Dvieju fk negali nurodyt sitai palevai tai istrina visus vertinimus, jei viena nurodai :DD Bbz kaip apeit, nes si tam sudui px, kad where nurodai :DDD
                //Baiges kantrybe, belekaip laiko sugaisau, veliau jauciu id sudesiu ir bus gerai, ka dabar kas daunas nezino, kad galima identifikuot irasus pagal kelis stulpelius :DDDDDDDDDDDDDDDDDDDDDDDDDD
                if (empty($isAlreadyEvaluated)) {
                    /*VietosVertinima::all()->where('fk_VARTOTOJASid', '=', $_SESSION['user']->id)->where('fk_LANKYTINA_VIETAid','=', $pid)->first()->delete();
                }*/
                    $newEvaluation = new VietosVertinima;
                    $newEvaluation->vertinimas = $evaluation;
                    $newEvaluation->fk_LANKYTINA_VIETAid = $pid;
                    $newEvaluation->fk_VARTOTOJASid = $_SESSION['user']->id;
                    $newEvaluation->save();
                }

            }
        }

        return redirect('\places');
    }

    public function visited($pid){
        return view('visited')->with('pid', $pid);
    }

    public function submitVisited(Request $request){
        session_start();
        if(!empty($_SESSION['user'])) {
            $this->validate($request, [
                'comment' => 'required'
            ]);
            //dar viena lentele be id :(
            $newVisitedPlace = new AplankytaVietum();
            $newVisitedPlace->komentaras = $request->input('comment');
            $newVisitedPlace->fk_VARTOTOJASid =$_SESSION['user']->id;
            $newVisitedPlace->fk_LANKYTINA_VIETAid = $request->input('pid');
            $newVisitedPlace->save();
        }

        return redirect('infoOfPlace/'.$request->input('pid').'/');
    }
}
