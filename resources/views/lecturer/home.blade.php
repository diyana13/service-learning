@extends('layouts.template-layout')

@section('content')
<div class="col-lg-12">
    <div class="card card-primary card-outline">
        <div class="card-header">
            <h5 class="m-0">Dashboard</h5>
        </div>
        <div class="card-body">
            <h6 class="card-title">Special title treatment</h6>

            <p class="card-text">With supporting text below as a natural lead-in to additional
                content.</p>
            <a href="{{ route('lecturer.projects') }}" class="btn btn-primary">Go to projects</a>
        </div>
    </div>
</div>
@endsection
