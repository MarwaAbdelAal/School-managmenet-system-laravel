@extends('layouts.app')

@section('content')

{!! Form::model($student, ['route' => ['students.update', $student], 'method' => 'put']) !!}

<div class="form-group">

    <div class="mb-3">
        <label for="IDno" class="form-label">IDno</label>

        {!! Form::text('IDno', null, [
        'class' => 'form-control',
        'placeholder' => 'Enter IDno here'
        ]) !!}

        @if ($errors->has('IDno'))
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->get('IDno') as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
    </div>

    <div class="mb-3">
        <label for="name" class="form-label">Name</label>

        {!! Form::text('name', null, [
        'class' => 'form-control',
        'placeholder' => 'Enter name here'
        ]) !!}

        @if ($errors->has('name'))
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->get('name') as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
    </div>

    <div class="mb-3">
        <label for="age" class="form-label">Age</label>

        {!! Form::text('age', null, [
        'class' => 'form-control',
        'placeholder' => 'Enter age here'
        ]) !!}

        @if ($errors->has('age'))
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->get('age') as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
    </div>

    <button type="submit" class="btn btn-success">UPDATE</button>

</div>

{!! Form::close() !!}

@endsection