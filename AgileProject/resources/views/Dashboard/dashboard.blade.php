@extends('Dashboard/layout')

@section('title', 'Home')

@section('content')


    <div class="content">
        <div class="container-fluid">
                    {{-- If the coach has a project --}}
                    @if($project)
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card ">
                                    <div class="header">
                                        <h4 class="title">{{ $project->name }}</h4>
                                        <p class="category">{{"Created at "}} {{$project->created_at->format('d M Y - H:i:s') }}</p>
                                    </div>
                                    <div class="content">
                                        <div class="table-full-width">
                                            <table class="table">
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            {{ $project->description }}
                                                        </td>
                                                    </tr>
                                                    {{-- if the coach has a superiore coach --}}
                                                    {{-- he can't delete the project --}}
                                                    @if(!$coach->hasBoss())
                                                    <tr>
                                                        <td>
                                                            <button type="button" class="btn btn-danger" onclick="event.preventDefault();
                                                                document.getElementById('delete_project_form').submit();">Delete Project</button>
                                                            <form id="delete_project_form" method="post" action="{{ route('delete_project') }}">
                                                                @csrf
                                                                <input type="hidden" name="project_id" value="{{ $project->id }}">
                                                                <input type="hidden" name="coach_id" value="{{ $coach->id }}">
                                                            </form>
                                                        </td>
                                                    </tr>
                                                    @endif
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    {{-- If no project is assigned --}}
                    @else
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card ">
                                    <div class="header">
                                                <h4 class="title">Create Project</h4>
                                                <p class="category">Create a project for your customer</p>
                                    </div>
                                    <div class="content">
                                        <div class="table-full-width">
                                            <table class="table">
                                                <tbody>
                                                    <form id='create_project_form' method='post' action="{{ route('create_project') }}">
                                                        {{ csrf_field() }}
                                                        <tr>
                                                            <td>
                                                                <div class="form-group">
                                                                    <label for="team_name">Project Name</label>
                                                                    <input type="hidden" name="coach_id" value="{{ $coach->id }}">
                                                                    <input type="text" name="project_name" class="form-control" id="project_name" aria-describedby="emailHelp" placeholder="Agile Project" required="required">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="project_description">Project Description</label>
                                                                    <textarea name="project_description" class="form-control" id="project_description" rows="3" required="required"></textarea>
                                                                </div>
                                                                <button type="button" class="btn btn-primary" onclick="event.preventDefault();
                                                            document.getElementById('create_project_form').submit();">Create</button>
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