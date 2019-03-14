@extends('Dashboard/layout')

@section('title', 'Home')

@section('content')

<div class="content">
        <div class="container-fluid">

                <div class="row">
                    <div class="col-md-12">
                        <div class="card ">
                            <div class="header">
                                <h4 class="title">Questions</h4>
                                <p class="category">Your coach sent you these questions</p>
                            </div>
                            <div class="content">
                                <div class="table-full-width">
                                    <table class="table">
                                        <tbody>

                                            {{-- If there are unanswered questions --}}
                                        	@if(count($questions))
                                        	@foreach($questions as $question)
                                            <tr>
                                            	<form id='question_{{ $question->id }}' method="post" action="{{ route('answer_question') }}">
                                            		@csrf
	                                                <td>{{ $question->getQuestion() }}
                                                        
                                                        <div class="form-group">
                                                            <input type="text" name="comment" class="form-control" aria-describedby="emailHelp" placeholder="Write your comment here">
                                                        </div>
                                                    </td>

                                                    <td>
	                                                	<input type="hidden" name="question_id" value="{{ $question->id }}">
	                                                	<input type="hidden" name="user_id" value="{{ Auth::id() }}">
	                                                	<select class="custom-select custom-select-lg mb-3" name="answer">
															<option selected disabled>Answer</option>
															<option value="1">1</option>
															<option value="2">2</option>
															<option value="3">3</option>
															<option value="4">4</option>
															<option value="5">5</option>
														</select>
	                                                </td>
	                                                <td>
			                                            <div class="btn btn-info">
			                                                <button type="button" rel="tooltip" title="Answer Questions" class="btn btn-info btn-simple btn-xs" onclick="event.preventDefault();
					                            				document.getElementById('question_{{ $question->id }}').submit();">Send</button>
			                                            </div>
		                                            </td>
	                                        	</form>
                                            </tr>
                                            @endforeach

                                            {{-- If all questions were answered --}}
                                            @else
                                            	<tr>
                                            		<td>
                                            			You Answered all your questions
                                            		</td>
                                            	</tr>
                                            	
                                            @endif

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






























