@extends('layouts.backend.main')

@section('admin-content')
    <div class=" " style="margin-top: 28%;margin-left: 38%;">
        <div class="col justify-content-center align-items-center">
            <a href="{{ route('admin.run.migration') }}" class="btn btn-outline-success">Run Migration</a>
            <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-dark">Back to Dashboard</a>
        </div>
    </div>
@endsection
