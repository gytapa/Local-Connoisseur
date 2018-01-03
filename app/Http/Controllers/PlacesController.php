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
    ///
    /// Metodas sistemoje išsaugotoms vietoms gauti
    /// retrun - atidaro langą su sistemoje esančiomis vietomis
    ///
    public function getPlaces(){
        if (session_status() != PHP_SESSION_ACTIVE) {
            session_start();
        }
        $places = LankytinaVietum::all();
        return view('places')->with('places', $places);
    }

    ///
    /// Metodas vietos informacijai gauti
    /// return - atidaro langą su vietos informacija, komentarais
    ///
    public function getInfoOfPlace($pid){
        if (session_status() != PHP_SESSION_ACTIVE) {
            session_start();
        }
        $place = LankytinaVietum::all()->where('id', '=', $pid)->first();
        $comments = Komentara::orderBy('laikas', 'DESC')->where('fk_LANKYTINA_VIETAid','=', $pid)->get();
        //$comments = Komentara::all()->Where('fk_LANKYTINA_VIETAid','=', $pid)->orderBy('ar_patvirtinta', 'DESC');
        return view('/infoOfPlace', ['place' => $place, 'comments' => $comments]);
    }

    ///
    /// Metodas vietai vertinti
    /// pid - vietos id, evaluation - vertinimas
    /// return vietos infromacijos langą
    ///
    public function Evaluate($pid, $evaluation){

        if (session_status() != PHP_SESSION_ACTIVE) {
            session_start();
        }
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
                $_SESSION['success'] = "Place was successfully evaluated.";
                return redirect('infoOfPlace/' . $pid);
            }
            else {
                $_SESSION['warning'] = "You need to log in to evaluate places.";
                return redirect('infoOfPlace/' . $pid);
            }
        }
        return redirect('infoOfPlace/'.$pid);
    }

    ///
    /// Metodas aplankytai vietai pažymėti
    /// pid - vietos id
    /// return - formą apie aplankytą vietą, arba home, jei vartotojas neprisijungęs
    public function visited($pid){
        if (session_status() != PHP_SESSION_ACTIVE) {
            session_start();
        }
        if (!empty($_SESSION['user'])) {
            $place = LankytinaVietum::all()->where('id', $pid)->first();
            return view('visited')->with(['pid' => $pid, 'name' => $place->pavadinimas]);
        }
        else
            return redirect('infoOfPlace/'.$pid);
    }

    ///
    /// Metodas aplankytai vietai išsaugoti
    /// request - aplankytos vietos duomenys
    /// return - vietos informacijos langą
    ///
    public function submitVisited(Request $request){
        if (session_status() != PHP_SESSION_ACTIVE) {
            session_start();
        }
        if(!empty($_SESSION['user']) && date(now()) > $request->input('date')) {
            $this->validate($request, [
                'comment' => 'required',
                'date' => 'required'
            ]);
            $newVisitedPlace = new AplankytaVietum();
            $newVisitedPlace->data = $request->input('date');
            $newVisitedPlace->komentaras = $request->input('comment');
            $newVisitedPlace->fk_VARTOTOJASid =$_SESSION['user']->id;
            $newVisitedPlace->fk_LANKYTINA_VIETAid = $request->input('pid');
            $newVisitedPlace->save();
            $_SESSION['success'] = "Place was added to your visits history.";
            return redirect('infoOfPlace/'.$request->input('pid').'/');
        }
        else{

            return redirect('infoOfPlace/'.$request->input('pid').'/');
        }

    }

    ///
    /// Apsilankymų istorijos metodas
    /// return - langą su aplankytomis vietomis arba home
    ///
    public function getVisits(){
        if (session_status() != PHP_SESSION_ACTIVE) {
            session_start();
        }
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
