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
            $newComment->tema = $request->input('topic');
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
                //Jei dar nevertinta
                if (empty($isAlreadyEvaluated)) {
                    $newEvaluation = new KomentaroVertinima;
                    $newEvaluation->vertinimas = $evaluation;
                    $newEvaluation->fk_KOMENTARASid = $cid;
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

        return redirect('infoOfPlace/'.$pid.'/');
    }

    public function delete($cid){
        session_start();
        $comment = Komentara::all()->where('id', $cid)->first();
        if(!empty($_SESSION['user'])){
            if($_SESSION['user']->role == 0 || $_SESSION['user']->id == $comment->fk_VARTOTOJASid){
                $placeid = $comment->fk_LANKYTINA_VIETAid;
                $evaluations = KomentaroVertinima::all()->where('fk_KOMENTARASid', $comment->id);
                foreach($evaluations as $evaluation){
                    KomentaroVertinima::destroy($evaluation->id);
                }
                Komentara::destroy($comment->id);
                return view('infoOfPlace/'.$placeid);
            }
            else
                return redirect('infoOfPlace/'.$comment->fk_LANKYTINA_VIETAid);
        }
        elseif (!empty($comment)){
            return redirect('infoOfPlace/'.$comment->fk_LANKYTINA_VIETAid);
        }
        else{
            return redirect()->route('home');
        }

    }

}
