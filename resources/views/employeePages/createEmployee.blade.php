@extends('layouts.testLayout')


@section('content')
<div class="container">
    <h2 class="text-center">Create Employee</h2>

    <form action="{{ route('employees.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label>Emp Id</label>
            <input type="text" name="emp_id" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Name</label>
            <textarea name="name" class="form-control" required></textarea>
        </div>
        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control">
        </div>
        <div class="mb-3">
            <label>Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Phone</label>
            <input type="tel" name="phone" class="form-control" maxLength="10" required >
        </div>
        <button type="submit" class="btn btn-primary">Create Employee</button>
    </form>
</div>
@endsection