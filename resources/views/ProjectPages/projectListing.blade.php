@extends('layouts.testLayout')

@section('content')
<div class="container">
    <h2 class="text-center">Project List</h2>

    <a href="{{ route('projects.create') }}" class="btn btn-success mb-3">Create Project</a>
    <a href="/admin/dashboard" class="btn btn-primary mb-3">Back</a>


    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Description</th>
                <th>Image</th>
                <th>Timeline (Days)</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($projects as $project)
            <tr>
                <td>{{ $project->id }}</td>
                <td>{{ $project->project_title }}</td>
                <td>{{ $project->description }}</td>
                <td>
                    @if($project->image)
                        <img src="{{ asset('storage/'.$project->image) }}" width="100px" height="50px" alt="Project Image">
                    @else
                        No Image
                    @endif
                </td>
                <td>{{ $project->timeline }}</td>
                <td>{{ $project->start_date }}</td>
                <td>{{ $project->end_date }}</td>
                <td>
                    <a href="{{ route('projects.edit', $project->id) }}" class="btn btn-warning">Edit</a>
                    <a href="{{ route('projects.delete', $project->id) }}" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection