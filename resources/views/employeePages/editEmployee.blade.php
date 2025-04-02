@extends('layouts.testLayout')


@section('content')
<div class="container">
    <h1>Edit employee</h1>

    <form action="{{ route('employees.update', $employee->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label>Emp Id</label>
            <input type="text" name="emp_id" class="form-control"  value="{{ $employee->emp_id }}" required>
        </div>
        <div class="mb-3">
            <label>Name</label>
            <textarea name="name" class="form-control" required> {{ $employee->name }}</textarea>
        </div>
        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" value="{{ $employee->email }}" required>
        </div>
        <div class="mb-3">
            <label>Password</label>
            <input type="password" name="password" class="form-control" value="{{ $employee->password }}" required>
        </div>
        <div class="mb-3">
            <label>Phone</label>
            <input type="tel" name="phone" class="form-control" maxLength="10" value="{{ $employee->phone }}" required >
        </div>
        <button type="submit" class="btn btn-primary">Update Employee</button>
    </form>
</div>
@endsection