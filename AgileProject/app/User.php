<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Position;

class User extends Authenticatable 
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'first_name', 'last_name', 'position_id', 'email', 'password', 'phone',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function position() {
        $position = Position::where('id', $this->position_id)->first();
        return $position->name;
    }

    //Check if the user is a coach
    public function isCoach() {
        $coach = Coach::where('user_id', $this->id)->first();
        return $coach ? true : false;
    }

    //check is this user belongs to a team
    public function hasTeam() {
        return TeamMembers::where('user_id', $this->id)->first() ? true : false;
    }

















}
