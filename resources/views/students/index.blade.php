@extends('layouts.app')

@section('content')

@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

<div class="container my-5">
    <div class="row text-center justify-content-between">
        <div class="col-8">
            <h1>Students</h1>
        </div>
        <div class="col-4">
            <a href="{{ route('students.create') }}" class="btn btn-primary">NEW</a>
        </div>
    </div>
</div>

<table class="table">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">IDno</th>
            <th scope="col">Name</th>
            <th scope="col">Age</th>
            <th scope="col">Track</th>
            <th scope="col">Edit</th>
            <th scope="col">Delete</th>
        </tr>
    </thead>
    <tbody>
        @foreach($students as $student)
        <tr>
            <th scope="row">{{ $loop->iteration }}</th>
            <td>{{ $student->IDno }}</td>
            <td>{{ $student->name }}</td>
            <td>{{ $student->age }}</td>
            <td>{{ $student->track->name }}</td>
            <td>
                <a href="{{ route('students.edit', $student) }}" class="btn btn-outline-success border-0"><i class="fa-solid fa-pen-to-square"></i></a>
            </td>
            <td>
                <form action="{{ route('students.destroy', $student) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-outline-danger border-0"><i class="fa-solid fa-trash"></i></button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection