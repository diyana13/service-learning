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
                                            @if (Auth::user()->id !== $member->student->id)
                                                @if ($member->is_evaluated == false && $member->is_evaluated_by_student == false)
                                                    <a href="{{ route('student.evaluate', ['project' => $project->id, 'group' => $member->group_id, 'groupMember' => $member->student->id]) }}"
                                                        class="btn btn-sm btn-warning">Evaluate</a>
                                                @else
                                                    <span class="text-success"><i class="fa fa-check"></i> Evaluated</span>
                                                @endif
                                            @else
                                                <button type="button" class="btn btn-sm btn-info" data-toggle="modal"
                                                    data-target="#student-marks">
                                                    <i class="fa fa-info-circle"></i> See Marks
                                                </button>
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

    <div class="modal fade" id="student-marks">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-info">
                    <h4 class="modal-title">{{ Auth::user()->name }}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th class="text-center">Marks By</th>
                                <th class="text-center">Marks (%)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-center">Lecturer</td>
                                @if($studentMarks->lecturer_score == null)
                                    <td class="text-center text-danger">Pending Evaluation</td>
                                @else
                                    <td class="text-center">{{ $studentMarks->lecturer_score }}</td>
                                @endif
                            </tr>
                            <tr>
                                <td class="text-center">Assessor</td>
                                @if($studentMarks->assessor_score == null)
                                    <td class="text-center text-danger">Pending Evaluation</td>
                                @else
                                    <td class="text-center">{{ $studentMarks->assessor_score }}</td>
                                @endif
                            </tr>
                            <tr>
                                <td class="text-center">Peers</td>
                                @if($studentMarks->peers_score == null)
                                    <td class="text-center text-danger">Pending Evaluation</td>
                                @elseif($isPeerEvaluated == false)
                                    <td class="text-center text-danger">Pending Evaluation</td>
                                @else
                                    <td class="text-center">{{ $studentMarks->peers_score }}</td>
                                @endif
                            </tr>
                        </tbody>
                    </table>
                    <hr>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Total Marks (50%)</th>
                                @if($studentMarks->total_score == null)
                                    <th class="text-center text-danger">Pending Evaluation</th>
                                @elseif($studentMarks->lecturer_score == null || $studentMarks->assessor_score == null || $studentMarks->peers_score == null)
                                    <th class="text-center text-danger">Pending Evaluation</th>
                                @else
                                    <th class="text-center">{{ $studentMarks->total_score }}</th>
                                @endif
                            </tr>
                        </thead>
                    </table>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
@endsection
