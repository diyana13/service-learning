@extends('layouts.template-layout')

@section('content')
    <div class="col-lg-12">
        <div class="card card-maroon card-outline">
            <div class="card-header">
                <div class="d-flex justify-content-end">
                    <a href="{{ route('student.student-project') }}" class="btn btn-sm btn-danger"><i
                            class="fa fa-angle-left"></i> Back</a>
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
                <h4><b>Project Details</b></h4>
                {{-- <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Code</th>
                            <th>Description</th>
                            <th>Lecturer</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $project->project_name }}</td>
                            <td>{{ $project->project_code }}</td>
                            <td>{{ $project->description }}</td>
                            <td>{{ $project->lecturer->name }}</td>
                        </tr>
                    </tbody>
                </table> --}}

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Project Name</label>
                    <div class="col-sm-1 col-form-label text-right"><strong>:</strong></div>
                    <div class="col-sm-9">
                        <p class="form-control-plaintext">{{ $project->project_name }}</p>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Project Code</label>
                    <div class="col-sm-1 col-form-label text-right"><strong>:</strong></div>
                    <div class="col-sm-9">
                        <p class="form-control-plaintext">{{ $project->project_code }}</p>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Description</label>
                    <div class="col-sm-1 col-form-label text-right"><strong>:</strong></div>
                    <div class="col-sm-9">
                        <p class="form-control-plaintext">{{ $project->description }}</p>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Lecturer</label>
                    <div class="col-sm-1 col-form-label text-right"><strong>:</strong></div>
                    <div class="col-sm-9">
                        <p class="form-control-plaintext">{{ $project->lecturer->name }}</p>
                    </div>
                </div>


                <div class="row mt-4">
                    <div class="col-12">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th class="text-center" style="width: 200px">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($groupMembers as $member)
                                    <tr>
                                        <th>{{ $member->student->name }}</th>
                                        <th class="text-center">
                                            @if(Auth::user()->id !== $member->student->id)
                                                
                                                @if($member->is_evaluated == false && $member->is_evaluated_by_student == false)
                                                    <a href="{{ route('student.evaluate', ['project' => $project->id, 'group' => $member->group_id, 'groupMember' => $member->student->id]) }}" class="btn btn-sm btn-warning">Evaluate</a>    
                                                @else
                                                    <span class="text-success"><i class="fa fa-check"></i> Evaluated</span>
                                                @endif
                                            @else
                                                <a href="#" class="btn btn-sm btn-primary">See Marks</a>
                                            @endif
                                        </th>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="2" class="text-center">No group members</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
        </div>
    </div>
    </div>
@endsection
