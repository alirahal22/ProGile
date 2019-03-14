@extends('Dashboard/layout')

@section('title', 'Team')


@section('content')
<div class="content">
    <div class="container-fluid">

        {{-- If Coach has a team --}}
        @if($team)

            {{-- Showing higher team members --}}
        	<div class="row">
        		<div class="col-md-12">
               		<div class="card ">
                    	<div class="header">
                                    <h4 class="title">General</h4>
                                    <p class="category">Product Owner and Scrum Master</p>
                    	</div>
                    	<div class="content">
                            <div class="table-full-width">
                                <table class="table">
                                    <tbody>
                                    	<?php $i=0 ?>
                                    	@foreach($general_members as $member)
                                    	@if($member)
                                        <tr>
                                          	<td>
                                            	<div class="label">
                                                    <label>{{ $member->username }}</label>
                                                </div>
                                            </td>

                                            <td>{{ $member->position() }}</td>
                                            
                                            <td class="td-actions text-right">
                                            	@if($i!=0)
                                                	<button type="button" rel="tooltip" title="Remove from Team" class="btn btn-danger btn-simple btn-xs" onclick="event.preventDefault();
    				                            	document.getElementById('remove-member-{{ $member->id }}').submit();">
                                                @endif
                                                @if($i==0)
                                                    <i class="fa fa-empty-set"></i>
                                                @else
                                                    <i class="fa fa-minus-square"></i>
                                                	</button>
                                                	<form id="remove-member-{{ $member->id }}" action="{{ route('remove_member') }}" method="POST" style="display: none;">
                                                		<input type="hidden" name="user_id" value="{{ $member->id }}">
                                                		<input type="hidden" name="team_id" value="{{ $team->id }}">
    		                                      	  @csrf
    		                                    	</form>
    		                                    @endif
                                            </td>
                                            
                                        </tr>
                                        <?php $i=1 ?>
                                        @endif
                                        @endforeach

                                        <tr>
                                            <td>
                                                <button type="button" class="btn btn-danger" onclick="event.preventDefault();
                                                    document.getElementById('delete_team_form').submit();">Delete Team</button>
                                                <form id="delete_team_form" method="post" action="{{ route('delete_team') }}">
                                                    @csrf
                                                    <input type="hidden" name="team_id" value="{{ $team->id }}">
                                                    <input type="hidden" name="coach_id" value="{{ $coach->id }}">
                                                </form>
                                            </td>
                                            <td></td>
                                            <td></td>
                                        </tr>

                                    </tbody>
                                </table>
    						</div>
                            <div class="footer">
                                <hr>
                                        
                            </div>
    		            </div>
                	</div>
            	</div>
            </div>


            {{-- Showing team members --}}

            <div class="row">
    			<div class="col-md-12">
                    <div class="card ">
                        <div class="header">
                                    <h4 class="title">{{ $team->name }}</h4>
                                    <p class="category">Team Members</p>
                        </div>
                        <div class="content">
                            <div class="table-full-width">
                                <table class="table">
                                    <tbody>
                                    	@foreach($team_members as $member)
                                            <tr>
                                              	<td>
                                                	<div class="label">
                                                        <label>{{ $member->username }}</label>
                                                    </div>
                                                </td>

                                                <td>{{ $member->position() }}</td>
                                                @if($member->isCoach())
                                                    
                                                    <td class="td-actions text-right">
                                                        <button type="button" rel="tooltip" title="Remove Coach" class="btn btn-danger btn-simple btn-xs" onclick="event.preventDefault();
                                                            document.getElementById('remove_coach_{{ $member->id }}').submit();">
                                                            Remove Coach
                                                        </button>

                                                        <form id='remove_coach_{{ $member->id }}' method="post" action="{{ route('remove_coach') }}">
                                                            @csrf
                                                            <input type="hidden" name="user_id" value="{{ $member->id }}">
                                                            <input type="hidden" name="project_id" value="{{ $project->id }}">
                                                        </form>

                                                </td>
                                                @else
                                                    <td>
                                                        <button type="button" rel="tooltip" title="Make Coach" class="btn btn-info btn-simple btn-xs" onclick="event.preventDefault();
                                                          document.getElementById('make_coach_{{ $member->id }}').submit();">
                                                            Make Coach
                                                        </button>
                                                        <form id='make_coach_{{ $member->id }}' method="post" action="{{ route('make_coach') }}">
                                                            @csrf
                                                            <input type="hidden" name="user_id" value="{{ $member->id }}">
                                                            <input type="hidden" name="project_id" value="{{ $project->id }}">
                                                        </form>

                                                    </td>
                                                @endif

                                                



                                                <td class="td-actions text-right">
                                                    <button type="button" rel="tooltip" title="Remove from Team" class="btn btn-danger btn-simple btn-xs" onclick="event.preventDefault();
        				                            document.getElementById('remove-member-{{ $member->id }}').submit();">
                                                        <i class="fa fa-minus-square"></i>
                                                    </button>
                                                    <form id="remove-member-{{ $member->id }}" action="{{ route('remove_member') }}" method="POST" style="display: none;">
                                                    	<input type="hidden" name="user_id" value="{{ $member->id }}">
                                                    	<input type="hidden" name="team_id" value="{{ $team->id }}">
        		                                        @csrf
        		                                    </form>
                                                </td>
                                            </tr>

                                            

                                            
                                        @endforeach

                                    </tbody>
                                </table>
    						</div>
                            <div class="footer">
                                <hr>
                            </div>
    		            </div>
    		        </div>
    		    </div>
    		</div>

            {{-- Showing available recruits --}}

    		<div class="row">
    			<div class="col-md-12">
                    <div class="card ">
                        <div class="header">
                            <h4 class="title">Add Team Members</h4>
                            <p class="category">Select members that work for you</p>
                        </div>
                        <div class="content">
                            <div class="table-full-width">
                                <table class="table">
                                    <tbody>
                                    	@foreach($other_members as $member)
                                        @if(!$member->isCoach())
                                        <tr>
                                          	<td>
                                            	<div class="label">
                                                    <label>{{ $member->username }}</label>
                                                </div>
                                            </td>

                                            <td>{{ $member->position() }}</td>

                                            <td class="td-actions text-right">
                                                <button type="button" rel="tooltip" title="Add to team" class="btn btn-info btn-simple btn-xs" onclick="event.preventDefault();
    				                            document.getElementById('add-member-{{ $member->id }}').submit();">
                                                    <i class="fa fa-plus-square"></i>
                                                </button>
                                                <form id="add-member-{{ $member->id }}" action="{{ route('add_member') }}" method="POST" style="display: none;">
                                                	<input type="hidden" name="user_id" value="{{ $member->id }}">
                                                	<input type="hidden" name="team_id" value="{{ $team->id }}">
    		                                        @csrf
    		                                    </form>
                                            </td>
                                        </tr>
                                        @endif

                                        @endforeach

                                    </tbody>
                                </table>
    						</div>
                            <div class="footer">
                                <hr>
                            </div>
    		            </div>
    		        </div>
    		    </div>
    		</div>


        {{-- if coach doesn't have a project --}}
        @elseif(!$project)
            <div class="row">
                <div class="col-md-12">
                    <div class="card ">
                        <div class="header">
                            <h4 class="title">Questions</h4>
                            <p class="category">Select Questions to ask your team</p>
                        </div>
                        <div class="content">
                            <div class="table-full-width">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td>
                                                <h3>Please Create a project first</h3>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        {{-- If Coach doesn't have a team --}}
        @else
            <div class="row">
            <div class="col-md-12">
                <div class="card ">
                    <div class="header">
                                <h4 class="title">Create Team</h4>
                                <p class="category">Create a team for your project</p>
                    </div>
                    <div class="content">
                        <div class="table-full-width">
                            <table class="table">
                                <tbody>
                                    <form id='create_team_form' method='post' action="{{ route('create_team') }}">
                                        {{ csrf_field() }}
                                        <tr>
                                            <td>
                                                <div class="form-group">
                                                    <label for="team_name">Team Name</label>
                                                    <input type="text" name="team_name" class="form-control" id="team_name" aria-describedby="emailHelp" placeholder="Agile Methodology" required="required">
                                                    <input type="hidden" name="coach_id" value="{{ $coach->id }}">
                                                </div>
                                                <button type="button" class="btn btn-primary" onclick="event.preventDefault();
                                            document.getElementById('create_team_form').submit();">Create</button>
                                            </td>
                                        </tr>
                                    </form>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif

        
			        

    </div>
</div>

@endsection
