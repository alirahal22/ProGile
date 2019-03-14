@extends('Dashboard/layout')

@section('title', 'Admin Board')


@section('content')

<div class="content">
    <div class="container-fluid">

        <div class="row">
			<div class="col-md-12">
                <div class="card ">
                    <div class="header">
                                <h4 class="title">Application Users</h4>
                                <p class="category">People that use this app</p>
                    </div>
                    <div class="content">
                        <div class="table-full-width">
                            <table class="table">
                                <tbody>
                                	@foreach($members as $member)
                                    {{-- Check if the member can be a coach or not --}}
                                	@if(!$member->hasTeam())
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
                                                        document.getElementById('remove_head_coach_{{ $member->id }}').submit();">
                                                        Remove Coach
                                                    </button>

                                                    <form id='remove_head_coach_{{ $member->id }}' method="post" action="{{ route('remove_head_coach') }}">
                                                        @csrf
                                                        <input type="hidden" name="user_id" value="{{ $member->id }}">
                                                    </form>

                                            </td>
                                            @else
                                                <td>
                                                    <button type="button" rel="tooltip" title="Make Coach" class="btn btn-info btn-simple btn-xs" onclick="event.preventDefault();
                                                      document.getElementById('make_head_coach_{{ $member->id }}').submit();">
                                                        Make Coach
                                                    </button>
                                                    <form id='make_head_coach_{{ $member->id }}' method="post" action="{{ route('make_head_coach') }}">
                                                        @csrf
                                                        <input type="hidden" name="user_id" value="{{ $member->id }}">
                                                    </form>

                                                </td>
                                            @endif
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

        
			        

    </div>
</div>

@endsection
