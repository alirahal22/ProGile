<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuestionnaireReceiver extends Model
{
	protected $fillable = ['user_id', 'questionnaire_id'];    
}
