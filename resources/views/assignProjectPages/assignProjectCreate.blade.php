@extends('layouts.testLayout')


@section('content')
<div class="container">
    <h2 class="text-center">Assigned Project</h2>

    <form action="{{ route('assignedProjects.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="project">Project</label>
            <select name="project_ids" id="project" class="form-control" required>
                <option value="" disabled selected>Select a Project</option>
                @foreach($projects as $project)
                <option value="{{ $project->id }}">{{ $project->title }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="employees">Employees</label>
            <select name="employees[]" id="employees" class="form-control " multiple required>
                @foreach($employees as $employee)
                <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Save Project</button>
    </form>

</div>
@endsection