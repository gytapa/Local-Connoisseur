<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Komentara;
use App\Models\KomentaroVertinima;

class CommentsController extends Controller
{
    ///
    /// Metodas sukurti naujam komentarui
    /// request - komentaro informacija
    /// return - nukreipia atgal i vietos informacijos langą
    ///
    public function send(Request $request){
        if (session_status() != PHP_SESSION_ACTIVE) {
            session_start();
        }
        if(!empty($_SESSION['user'])) {
            $this->validate($request, [
                'topic' => 'required',
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
            $_SESSION['success'] = "Review was send.";
            return redirect('infoOfPlace/'.$request->input('pid').'/');
        }
        $_SESSION['warning'] = "You need to log in to write a review.";
        return redirect('infoOfPlace/'.$request->input('pid').'/');
    }

    ///
    /// Metodas komentaro vertinimui
    /// cid - komentaro id, evaluation - vertinimo reikšmė, pid - vietos id
    /// return - nukreipia atgal i vietos informacijos langą
    ///
    public function Evaluate($cid, $evaluation,$pid)
    {
        if (session_status() != PHP_SESSION_ACTIVE) {
            session_start();
        }
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
                $_SESSION['success'] = "Evaluation was successfull.";
                return redirect('infoOfPlace/'.$pid.'/');
            }
            $_SESSION['warning'] = "You need to log in to evaluate.";
            return redirect('infoOfPlace/'.$pid.'/');
        }
        $_SESSION['danger'] = "Bad evaluation.";
        return redirect('infoOfPlace/'.$pid.'/');
    }

    ///
    /// Metodas komentaro trynimui
    /// cid - komentaro id
    /// return - atgal i vietos informacijos langą arba į home, jei vartotojas neprisijungęs
    ///
    public function delete($cid){
        if (session_status() != PHP_SESSION_ACTIVE) {
            session_start();
        }
        $comment = Komentara::all()->where('id', $cid)->first();
        if(!empty($_SESSION['user'])){
            if($_SESSION['user']->role == 0 || $_SESSION['user']->id == $comment->fk_VARTOTOJASid){
                $placeid = $comment->fk_LANKYTINA_VIETAid;
                $evaluations = KomentaroVertinima::all()->where('fk_KOMENTARASid', $comment->id);
                foreach($evaluations as $evaluation){
                    KomentaroVertinima::destroy($evaluation->id);
                }
                Komentara::destroy($comment->id);
                $_SESSION['success'] = "Comment was succesfully deleted.";
                return view('infoOfPlace/'.$placeid);
            }
            else
                $_SESSION['warning'] = "You can't delete this comment.";
                return redirect('infoOfPlace/'.$comment->fk_LANKYTINA_VIETAid);
        }
        elseif (!empty($comment)){
            return redirect('infoOfPlace/'.$comment->fk_LANKYTINA_VIETAid);
        }
        else{
            return redirect()->route('home');
        }

    }

    ///
    /// Metodas komentarui keisti
    /// cid - komentaro id
    /// return - atgal į komentaro keitimo langą arba į home, jei neprisijungęs vartotojas
    ///
    public function edit($cid){
        if (session_status() != PHP_SESSION_ACTIVE) {
            session_start();
        }
        $comment = Komentara::all()->where('id', $cid)->first();
        if(!empty($_SESSION['user'])){
            if($_SESSION['user']->id == $comment->fk_VARTOTOJASid){
                return view('editComment')->with(['comment' => $comment]);
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

    ///
    /// Metodas komentaro keitimui išsaugoti
    /// request - nauji komentaro duomenys
    /// return - atgal į vietos informacijos langą arba į home, jei neprisijungęs vartotojas
    ///
    public function editSubmit(Request $request){
        if (session_status() != PHP_SESSION_ACTIVE) {
            session_start();
        }
        $comment = Komentara::all()->where('id', $request->input('cid'))->first();
        if(!empty($_SESSION['user'])){
            $this->validate($request, [
                'topic' => 'required',
                'text' => 'required'
            ]);
            if($_SESSION['user']->id == $comment->fk_VARTOTOJASid){
                $comment->tema = $request->input('topic');
                $comment->tekstas = $request->input('text');
                $comment->save();
            }
            $_SESSION['success'] = "Comment was succesfully edited.";
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
