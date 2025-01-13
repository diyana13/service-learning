@extends('layouts.template-layout')

@section('content')
<div class="col-lg-12">
    <div class="card card-primary card-outline">
        <div class="card-header">
            <div class="d-flex justify-content-end">
                <a href="{{ route('assessor.project-list') }}" class="btn btn-sm btn-danger"><i class="fa fa-angle-left"></i> Back</a>
            </div>
        </div>

        <div class="card-body">
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Project Name</label>
                <div class="col-sm-1 col-form-label text-right"><strong>:</strong></div>
                <div class="col-sm-9">
                    <p class="form-control-plaintext">{{ $project->project_name }}</p>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Project Code:</label>
                <div class="col-sm-1 col-form-label text-right"><strong>:</strong></div>
                <div class="col-sm-9">
                    <p class="form-control-plaintext">{{ $project->project_code }}</p>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Description:</label>
                <div class="col-sm-1 col-form-label text-right"><strong>:</strong></div>
                <div class="col-sm-9">
                    <p class="form-control-plaintext">{{ $project->description }}</p>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Lecturer:</label>
                <div class="col-sm-1 col-form-label text-right"><strong>:</strong></div>
                <div class="col-sm-9">
                    <p class="form-control-plaintext">{{ $project->lecturer->name }}</p>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <form action="{{ route('assessor.register', $project->id) }}" method="POST">
                @csrf
                {{-- submit button --}}
                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-sm btn-primary" style="width: 300px;">Register</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection