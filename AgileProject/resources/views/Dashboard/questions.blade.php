@extends('Dashboard/layout')

@section('title', 'Questionnaire')

@section('content')
<div class="content">
    <div class="container-fluid">        
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

                                    	{{-- If the coach actually has a team --}}
                                    	@if($team)
	                                    	<form id="questionnaire_form" method="post" action="{{ route('create_questionnaire') }}">
		                                        {{ csrf_field() }}
		                                        <input type="hidden" name="team_id" value="{{ $team->id }}">
		                                        <input type="hidden" name="coach_id" value="{{ $coach->id }}">
		                                        <tbody>

		                                        	{{-- Show all available Questions --}}
		                                        	@foreach($questions as $question)
		                                            <tr>
		                                                <td>
		                                                    <div class="checkbox">
		                                                        <input id="checkbox{{ $question->id }}" type="checkbox" name="questions[]" value="{{ $question->id }}">
		                                                        <label for="checkbox{{ $question->id }}"></label>
		                                                    </div>
		                                                </td>
		                                                <td>{{ $question->question }}</td>
		                                                <td class="td-actions text-right">
		                                                    <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-simple btn-xs">
		                                                        <i class="fa fa-empty-set"></i>
		                                                    </button>
		                                                </td>
		                                            </tr>
		                                            @endforeach

		                                            {{-- Select receivers --}}
		                                            <tr>
		                                            	<td>
		                                            		<h3>Who Are you sending these for?</h3>
		                                            	<td>
		                                           		<td></td>
		                                           		<td></td>
		                                            </tr>
		                                            <tr>
		                                            	<td>
		                                                    <div class="checkbox">
		                                                        <input id="to_scrum_master" type="checkbox" name="to_scrum_master">
		                                                        <label for="to_scrum_master">Scrum Master</label>
		                                                    </div>
		                                                </td>
		                                                <td>
		                                                    <div class="checkbox">
		                                                        <input id="to_product_owner" type="checkbox" name="to_product_owner">
		                                                        <label for="to_product_owner">Product Owner</label>
		                                                    </div>
		                                                </td>
		                                                <td></td>
		                                            </tr>
		                                            <tr>
		                                                <td>
		                                                    <div class="checkbox">
		                                                        <input id="to_team_members" type="checkbox" name="to_team_members"">
		                                                        <label for="to_team_members">Team Members</label>
		                                                    </div>

		                                                </td>
		                                                <td>
		                                                    
		                                                    <div class="checkbox">
		                                                        <input id="to_all_coaches" type="checkbox" name="to_all_coaches">
		                                                        <label for="to_all_coaches">Coaches</label>
		                                                    </div>
		                                                </td>
		                                                <td></td>
		                                            </tr>
		                                            <tr>
		                                            	<td>
		                                                    <div class="checkbox">
		                                                        <input id="to_all_members" type="checkbox" name="to_all_members">
		                                                        <label for="to_all_members">Everyone</label>
		                                                    </div>
		                                                </td>
		                                            	<td>
			                                            	<div class="btn btn-info">
			                                                    <button type="button" rel="tooltip" title="Send Questions" class="btn btn-info btn-simple btn-xs" onclick="event.preventDefault();
					                            					document.getElementById('questionnaire_form').submit();">Send</button>
			                                                </div>
		                                            	</td>
		                                            	<td></td>
		                                            	
		                                            </tr>

		                                            
		                                        </tbody>
		                                        
	                                    	</form>
	                                    {{-- If the coach doesn't have a team --}}
	                                    @else
	                                    	<tr>
	                                    		<td>
	                                    			<h3>Please Create a team first</h3>
	                                    		</td>
	                                    	</tr>
	                                    @endif
                                    	
                                    </table>
                                </div>

                                <div class="footer">
                                    <hr>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
    </div>
</div>

@endsection