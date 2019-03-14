<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Coach;
use App\Project;
use App\Team;
use App\TeamMembers;
use App\FixedQuestion;
use App\QuestionnaireReceiver;
use App\Question;
use App\Questionnaire;
use App\Answer;
use App\Admin;
use DB;

class NavigationController extends Controller
{

    ///////////////////////////////////////////////////////////////////////////////////////////////

    /////////////////////////                   Coach               ///////////////////////////////
    
    ///////////////////////////////////////////////////////////////////////////////////////////////

    public function project() {
        $option = 'project';
        $coach = Coach::where('user_id', Auth::id())->first();
        $project = null;

        if ($coach != null) {
            $project = Project::where('id', $coach->project_id)->first(); 
            return view('Dashboard.dashboard', [
                'option' => $option, 'coach' => $coach,
                'admin' => null, 'project' => $project
            ]);           
        }

        $admin = Admin::where('user_id', Auth::id())->first();
        if ($admin)
            return $this->admin();
        return $this->member();
        
    }

    public function team() {
        $option = 'team';

        $team_members = null;
        $other_members = null;
        $scrum_master = null;
        $product_owner = null;

        $coach = Coach::where('user_id', Auth::id())->first();
        if ($coach != null) {
            $project = Project::where('id', $coach->project_id)->first(); 
            $team = Team::where('coach_id', $coach->id)->first();
            if ($team != null ) {
                $team_members_id = TeamMembers::where('team_id', $team->id)->get(['user_id']);

                $team_members = User::whereIn('id', $team_members_id)->whereNotIn('position_id' ,[1,2])->get();
                $other_members = User::whereNotIn('id', $team_members_id)->get();
                $product_owner = User::whereIn('id', $team_members_id)->where('position_id', '1')->first();
                $scrum_master = User::whereIn('id', $team_members_id)->where('position_id', '2')->first();
            }
            $general_members = [$coach, $product_owner, $scrum_master];
            return view('Dashboard.teams', ['option' => $option, 'coach' => $coach, 
                'project' => $project, 'team' => $team,
                'team_members' => $team_members, 'other_members' => $other_members,
                'admin' => null,'general_members' => $general_members
            ]);
        }
    	return $this->member();
    }

    public function questions() {
        $option = 'questions';

        $coach = Coach::where('user_id', Auth::id())->first();
        $product_owner = null;
        $scrum_master = null;
        $team_members = null;
        $other_members = null;

        $questions = FixedQuestion::all();
    	if ($coach != null) {
            $project = Project::where('id', $coach->project_id)->first(); 
            $team = Team::where('coach_id', $coach->id)->first();
            if ($team != null ) {
                $team_members_id = TeamMembers::where('team_id', $team->id)->get(['user_id']);

                $team_members = User::whereIn('id', $team_members_id)->whereNotIn('position_id' ,[1,2])->get();
                $other_members = User::whereNotIn('id', $team_members_id)->get();
                $product_owner = User::whereIn('id', $team_members_id)->where('position_id', '1')->first();
                $scrum_master = User::whereIn('id', $team_members_id)->where('position_id', '2')->first();
            }
            $general_members = [$coach, $product_owner, $scrum_master];
            return view('Dashboard.questions', ['option' => $option, 'coach' => $coach, 
                'project' => $project,'admin' => null, 'team' => $team,
                'team_members' => $team_members, 'other_members' => $other_members,
                '$product_owner' => $product_owner, 'scrum_master' => $scrum_master,
                'general_members' => $general_members, 'questions' => $questions
            ]);
        }
        return $this->member();
    }

    public function answers() {
        $option = 'answers';
        $user_id = Auth::id();
        $coach = Coach::where('user_id', Auth::id())->first();
        $questionnaires = QuestionnaireReceiver::where('user_id', $user_id)->get(['questionnaire_id']);
        $questions = array();

        foreach($questionnaires as $questionnaire){
            $ques = Question::where('questionnaire_id', $questionnaire['questionnaire_id'])->get();

            for($i=0; $i<count($ques); $i++){
                if (!$ques[$i]->answered($user_id))
                    $questions[] = $ques[$i];
            }
        }
        
        return view('Dashboard.member', [
            'option' => $option,'admin' => null,
            'coach' => $coach,
            'questions' => $questions
        ]);
    }

    public function statistics() {
        $option = 'statistics';
        $coach = Coach::where('user_id', Auth::id())->first();
    	return view('Dashboard.statistics', [
            'option' => $option,'admin' => null,
            'coach' => $coach
        ]);
    }













    ///////////////////////////////////////////////////////////////////////////////////////////////

    /////////////////////////                   Admin               ///////////////////////////////
    
    ///////////////////////////////////////////////////////////////////////////////////////////////



    public function admin() {
        $admin = Admin::where('user_id', Auth::id())->first();
        $members = User::all();
        return view('Dashboard.admin', [
            'admin' => $admin,
            'members' => $members
        ] );
    }

    public function make_head_coach() {
        Coach::create([
            'user_id' => request('user_id'),
        ]);
        return redirect()->route('admin');
    }

    public function remove_head_coach() {
        $coach = Coach::where('user_id', request('user_id'))->first();
        if($coach){
            $coach->deleteTeam();
            $coach->deleteProject();
            $coach->delete();
        }
        return redirect()->route('admin');
    }



    ///////////////////////////////////////////////////////////////////////////////////////////////

    /////////////////////////                   Members               /////////////////////////////
    
    ///////////////////////////////////////////////////////////////////////////////////////////////


    public function member() {
        $user_id = Auth::id();
        $questionnaires = QuestionnaireReceiver::where('user_id', $user_id)->get(['questionnaire_id']);
        $questions = array();

        foreach($questionnaires as $questionnaire){
            $ques = Question::where('questionnaire_id', $questionnaire['questionnaire_id'])->get();

            for($i=0; $i<count($ques); $i++){
                if (!$ques[$i]->answered($user_id))
                    $questions[] = $ques[$i];
            }
        }
        
        return view('Dashboard.member', [
            'coach' => null,
            'admin' => null,
            'questions' => $questions
        ]);
    }

    public function answer_question(Request $request) {
        if ($request->has('answer')) {
            Answer::create([
                'answer' => request('answer'),
                'question_id' => request('question_id'),
                'user_id' => request('user_id'),
                'comment' => request('comment')
            ]);
        }
        return redirect()->route('member');
    }












    


    //Add a member to the team //teams
    public function add_member() {
        TeamMembers::create([
            'user_id' => request('user_id'),
            'team_id' => request('team_id')
        ]);
        return redirect()->route('team');
    }

    //Remove a member from the team //teams
    public function remove_member() {
        $user = User::where('id', request('user_id'))->first();
        if ($user->isCoach()) {
            $coach = Coach::where('user_id', request('user_id'))->first();
            $this->remove_coach_team($coach->id);
            $coach->delete();

        }
        DB::delete('delete from team_members where user_id = ?',[request('user_id')]);
        return redirect()->route('team');
    }

    //Send the Questionnaire to selected members //questions
    public function create_questionnaire(Request $request){

        $questions = request('questions');
        if (count($questions) == 0) {
            return redirect()->route('questions');
        }
        $team_id = request('team_id');
        $coach_id = request('coach_id');
        $questionnaire = Questionnaire::create(['name' => 'asdfghj']);
        $questionnaire_id = $questionnaire->id;
        foreach($questions as $question_id){
            Question::create([
                'fixed_question_id' => $question_id,
                'questionnaire_id' => $questionnaire_id
            ]);
        }

        if ($request->has('to_all_members')) {
            $this->send_questionnaire_to_all_members($team_id, $questionnaire_id);
            return redirect()->route('project');
        }
        if ($request->has('to_team_members')) {
            $this->send_questionnaire_to_team($team_id, $questionnaire_id);   
        }
        if ($request->has('to_scrum_master')) {
            $this->send_questionnaire_to_scrum_master($team_id, $questionnaire_id);
        }
        if ($request->has('to_all_coaches')) {
            $this->send_questionnaire_to_coaches($team_id, $questionnaire_id);
        }
        if ($request->has('to_product_owner')) {
            $this->send_questionnaire_to_product_owner($team_id, $questionnaire_id);
        }
        return redirect()->route('project');
    }

    public function send_questionnaire_to_all_members($team_id, $questionnaire_id){
        $team_members_id = TeamMembers::where('team_id', $team_id)->get(['user_id']);
        foreach($team_members_id as $id) {
            QuestionnaireReceiver::create([
                'user_id' => $id['user_id'],
                'questionnaire_id' => $questionnaire_id
            ]);
        }
    }

    public function send_questionnaire_to_team($team_id, $questionnaire_id){
        $team_members_id = TeamMembers::where('team_id', $team_id)->get(['user_id']);
        foreach($team_members_id as $id) {
            $user = User::where('id', $id['user_id'])->first();
            if ( $user->position_id != 1 && $user->position_id != 2 && !$user->isCoach())
            QuestionnaireReceiver::create([
                'user_id' => $id['user_id'],
                'questionnaire_id' => $questionnaire_id
            ]);
        }
    }

    public function send_questionnaire_to_coaches($team_id, $questionnaire_id){
        $team_members_id = TeamMembers::where('team_id', $team_id)->get(['user_id']);
        foreach($team_members_id as $id) {
            $user = User::where('id', $id['user_id'])->first();
            if ( $user->isCoach() )
            QuestionnaireReceiver::create([
                'user_id' => $id['user_id'],
                'questionnaire_id' => $questionnaire_id
            ]);
        }
    }

    public function send_questionnaire_to_scrum_master($team_id, $questionnaire_id) {
        $team_members_id = TeamMembers::where('team_id', $team_id)->get(['user_id']);
        foreach($team_members_id as $id) {
            $user = User::where('id', $id['user_id'])->first();
            if ( $user->position_id == 2 )
            QuestionnaireReceiver::create([
                'user_id' => $id['user_id'],
                'questionnaire_id' => $questionnaire_id
            ]);
        }
    }

    public function send_questionnaire_to_product_owner($team_id, $questionnaire_id){
        $team_members_id = TeamMembers::where('team_id', $team_id)->get(['user_id']);
        foreach($team_members_id as $id) {
            $user = User::where('id', $id['user_id'])->first();
            if ( $user->position_id == 1 )
            QuestionnaireReceiver::create([
                'user_id' => $id['user_id'],
                'questionnaire_id' => $questionnaire_id
            ]);
        }
    }



    //Create a project if one doesn't exist //project
    public function create_project() {
        $project_name = request('project_name');
        $project_description = request('project_description');
        $coach_id = request('coach_id');

        $project = Project::create([
            'name' => $project_name,
            'description' => $project_description
        ]);

        $coach = Coach::find($coach_id);
        $coach->project_id = $project->id;
        $coach->save();

        return redirect()->route('project');
    }

    //Create a team if one doesn't exist //team
    public function create_team() {
        $team_name = request('team_name');
        $coach_id = request('coach_id');

        Team::create([
            'name' => $team_name,
            'coach_id' => $coach_id
        ]);

        return redirect()->route('team');
    }

    //Make a team_member a coach //team
    public function make_coach() {
        Coach::create([
            'user_id' => request('user_id'),
            'project_id' => request('project_id')
        ]);
        return redirect()->route('team');
    }

    //Remove a coach but keep him as team_member //team
    public function remove_coach() {
        $coach = Coach::where('user_id', request('user_id'))->first();
        if($coach){
            $coach->deleteTeam();
            $coach->delete();
        }
        return redirect()->route('team');
    }


    public function delete_project() {

        //remove sub coaches
        $coaches = Coach::where('project_id', request('project_id'))->get();
        foreach($coaches as $coach) {
            if ($coach->hasBoss()){
                $coach->deleteTeam();
                $coach->delete();
            }
        }

        //remove team members of head coach
        $coach = Coach::where('id', request('coach_id'))->first();
        $coach->deleteTeam();

        //delete project

        $project = Project::where('id', request('project_id'))->first();
        $project->delete();
        


        return redirect()->route('project');
    }

    public function delete_team() {
        $coach = Coach::where('id', request('coach_id'))->first();
        if($coach)
            $coach->deleteTeam();
        return redirect()->route('team');
    }



}



























