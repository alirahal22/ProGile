<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class TeamMembers extends Model
{
	public $timestamps = false;
	
    protected $fillable = [
    	'user_id', 
    	'team_id'
	];
}
