@extends('layouts.template-layout')

@section('content')
<div class="col-lg-12">
    <div class="card card-primary card-outline">
        <div class="card-header">
            <div class="d-flex justify-content-end">
                <a href="{{ route('student.student-project') }}" class="btn btn-sm btn-danger">Back</a>
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
            <!-- Add more fields as needed -->
            <hr>

            <form action="{{ route('student.register', $project->id) }}" method="POST">
                @csrf
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Group</label>
                    <div class="col-sm-1 col-form-label text-right"><strong>:</strong></div>
                    <div class="col-sm-9">
                        <select name="group_id" id="group_id" class="form-control">
                            <option value="">-- Select Group --</option>
                            @foreach ($groups as $group)
                                <option value="{{ $group->id }}">Group {{ $loop->iteration }} ({{ $group->members->count() }}/{{ $project->max_group_members }})</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                {{-- submit button --}}
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">Register</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection