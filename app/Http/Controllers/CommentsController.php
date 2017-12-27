<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Komentara;
use App\Models\KomentaroVertinima;

class CommentsController extends Controller
{
    public function send(Request $request){
        session_start();
        if(!empty($_SESSION['user'])) {
            $this->validate($request, [
                'comment' => 'required'
            ]);
            $newComment = new Komentara();
            $newComment->tekstas = $request->input('comment');
            $newComment->laikas = date('Y-m-d H:i:s');
            $newComment->ip_adresas = $_SERVER['REMOTE_ADDR'];
            $newComment->fk_VARTOTOJASid =$_SESSION['user']->id;
            $newComment->fk_LANKYTINA_VIETAid = $request->input('pid');
            $newComment->save();
        }

        return redirect('infoOfPlace/'.$request->input('pid').'/');

    }

    public function Evaluate($cid, $evaluation,$pid)
    {

        session_start();
        if ($evaluation == 1 || $evaluation == -1) {
            if (!empty($_SESSION['user'])) {
                $isAlreadyEvaluated = KomentaroVertinima::all()->where('fk_VARTOTOJASid', '=', $_SESSION['user']->id)->where('fk_KOMENTARASid', '=', $cid)->first();

                //Problema, kaip su vietos vertinimu, neberaginsiu jau :DD
                if (empty($isAlreadyEvaluated)) {
                    /*VietosVertinima::all()->where('fk_VARTOTOJASid', '=', $_SESSION['user']->id)->where('fk_LANKYTINA_VIETAid','=', $pid)->first()->delete();
                }*/
                    $newEvaluation = new KomentaroVertinima;
                    $newEvaluation->vertinimas = $evaluation;
                    $newEvaluation->fk_KOMENTARASid = $cid;
                    $newEvaluation->fk_VARTOTOJASid = $_SESSION['user']->id;
                    $newEvaluation->save();
                }

            }
        }

        return redirect('infoOfPlace/'.$pid.'/');
    }
}
