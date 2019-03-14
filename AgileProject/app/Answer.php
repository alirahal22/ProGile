<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{

	public $timestamps = false;

    protected $fillable = [
    	'answer',
    	'question_id',
    	'user_id',
    	'comment'
    ];
}
