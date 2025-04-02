@extends('layouts.testLayout')


@section('content')
<div class="container">
    <h1>Edit Project</h1>

    <form action="/projects/update/{{ $project->id }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="project_title" class="form-label">Project Title</label>
            <input type="text" class="form-control" id="project_title" name="project_title" value="{{ $project->project_title }}" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description" rows="3" required>{{ $project->description }}</textarea>
        </div>
            <div class="mb-3">
                <label>Image:</label>
                <input type="file" name="image" class="form-control" >
            </div>
        <div class="mb-3">
            <label for="start_date" class="form-label">Start Date</label>
            <input type="date" class="form-control" id="start_date" name="start_date" value="{{ $project->start_date }}" required>
        </div>
        <div class="mb-3">
            <label for="end_date" class="form-label">End Date</label>
            <input type="date" class="form-control" id="end_date" name="end_date" value="{{ $project->end_date }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Update Project</button>
    </form>
</div>
@endsection