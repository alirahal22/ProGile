<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\TeamMembers;
use DB;

class Coach extends Model
{
	public $timestamps = false;
	public $username = "You";
	public function position() {
		return "Main Coach";
	}

	protected $fillable = [
		'user_id',
		'project_id'
	];

	
	public function hasBoss(){
		//check if this coach has a superior coach, 
		//to prevent him from deleting the project
        return TeamMembers::where('user_id', $this->user_id)->first() ? true : false;
    }

    public function deleteTeam() {
    	//remove all team members
        //delete team
    	$team = Team::where('coach_id', $this->id)->first();
        if ($team) {
        	$team_members = TeamMembers::where('team_id', $team->id);
        	foreach ($team_members as $member) {
        		if ($member->isCoach()) {
        			$coach = Coach::where('user_id', $member->id)->first();
        		}
        	}
            DB::delete('delete from team_members where team_id = ?',[$team->id]);
            $team->delete();
        }
    }

    public function deleteProject() {
    	if ($this->project_id) {
    		$project = Project::where('id', $this->project_id)->first();
    		if($project)
    			$project->delete();
    	}
    	
    }
}
