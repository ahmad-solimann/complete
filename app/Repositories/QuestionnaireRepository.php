<?php


namespace App\Repositories;


use App\Models\Notification;
use App\Models\Questionnaire;

class QuestionnaireRepository
{
    public function delete (Questionnaire $questionnaire){
        $notifications= Notification::where('data->id',$questionnaire->id)->get();
        foreach ($notifications as $notification){
            $notification->delete();
        }
        $questionnaire->delete();
    }

}