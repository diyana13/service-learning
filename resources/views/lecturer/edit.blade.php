@extends('layouts.template-layout')

@section('content')
<div class="col-lg-12">
    <div class="card card-primary card-outline">
        <div class="card-header">
            <div class="d-flex justify-content-end">
                <a href="{{ route('lecturer.projects') }}" class="btn btn-sm btn-danger">Back</a>
            </div>
        </div>

        <div class="card-body">
            @if ($message = Session::get('success'))
            <div class="alert alert-success" role="alert">
                {{ $message }}
            </div>
            @endif

            @if ($message = Session::get('error'))
            <div class="alert alert-danger" role="alert">
                {{ $message }}
            </div>
            @endif

            <form method="POST" action="{{ route('lecturer.update', $project->id) }}">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <div class="form-group">
                        <label for="project_name">Name</label>
                        <input type="text"  class="form-control" name="project_name"
                            value="{{ old('project_name') ?? $project->project_name }}">
                        @error('project_name')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="project_code">Code</label>
                        <input type="text"  class="form-control" name="project_code"
                            value="{{ old('project_code') ?? $project->project_code }}" readonly>
                        @error('project_code')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control"  name="description">{{ old('description') ?? $project->description }}</textarea>
                        @error('description')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-6">
                                <label for="max_groups">Max Group</label>
                                <input type="number"  class="form-control" name="max_groups"
                                    value="{{ old('max_groups') ?? $project->max_groups }}">
                                @error('max_groups')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-6">
                                <label for="max_group_members">Max Group Members</label>
                                <input type="number"  class="form-control" name="max_group_members"
                                    value="{{ old('max_group_members') ?? $project->max_group_members }}">
                                @error('max_group_members')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-4">
                                <label for="mark_lecturer">Mark Lecturer</label>
                                <input type="number"  class="form-control" name="mark_lecturer"
                                    value="{{ old('mark_lecturer') ?? $project->mark_lecturer }}">
                                @error('mark_lecturer')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-4">
                                <label for="mark_student">Mark Student</label>
                                <input type="number"  class="form-control" name="mark_student"
                                    value="{{ old('mark_student') ?? $project->mark_student }}">
                                @error('mark_student')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-4">
                                <label for="mark_assessor">Mark Assessor</label>
                                <input type="number"  class="form-control" name="mark_assessor"
                                    value="{{ old('mark_assessor') ?? $project->mark_assessor }}">
                                @error('mark_assessor')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-block btn-success">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection