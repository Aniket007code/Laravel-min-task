@extends('layouts.testLayout')

@section('content')
<div class="container">
    <h2 class="text-center">Assigned Projects List</h2>

    <a href="{{ route('assignedProjects.create') }}" class="btn btn-success mb-3">Assign Project</a>
    <a href="/admin/dashboard" class="btn btn-primary mb-3">Back</a>


    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Project Name</th>
                <th>Assigned Employees</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>

            @foreach($assignProjects as $project)
            <tr>

                <td>{{ $project['id'] }}</td>
                <td>{{ $project['project_title'] }}</td>
                <td>{{ $project['employee_name'] }}</td>
                <td>
                    <a href="{{ route('assignedProjects.edit', $project['id']) }}" class="btn btn-warning">Edit</a>
                    <a href="{{ route('assignedProjects.delete', $project['id']) }}" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection