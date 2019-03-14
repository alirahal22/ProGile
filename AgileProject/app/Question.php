<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\FixedQuestion;
use App\Answer;

class Question extends Model
{
	public $timestamps = false;
    protected $fillable = [
    	'fixed_question_id',
    	'questionnaire_id'
    ];

    //get the value of the queestion
    public function getQuestion() {
    	$fixed_question = FixedQuestion::where('id', $this->fixed_question_id)->first();
    	return $fixed_question->question;
    }

    //check if the user has answered this question
    public function answered($user_id) {
    	$answered = Answer::where('question_id', $this->id)->where('user_id', $user_id)->first();
    	if($answered)
    		return true;
    	return false;
    }
}
