@extends('layouts.template-layout')

@section('content')
<div class="col-lg-12">
    <div class="card card-maroon card-outline">
        <div class="card-header">
            <div class="card-title">
                Students Mark
            </div>
            <div class="card-tools">
                <a href="{{ route('lecturer.projects') }}" class="btn btn-sm btn-danger"><i class="fa fa-angle-left"></i> Back</a>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th style="width: 45rem">Student Name</th>
                        <th class="text-center">Lecturer Marks (%)</th>
                        <th class="text-center">Assessor Marks (%)</th>
                        <th class="text-center">Peers Marks (%)</th>
                        <th class="text-center">Total Marks (%)</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($students as $student)
                        <tr>
                            <td>{{ $student->users->name }}</td>
                            @if ($student->lecturer_score == null)
                                <td class="text-center"><span class="text-danger"><b>Pending Evaluation</b></span></td>
                            @else
                                <td class="text-center">{{ $student->lecturer_score }}</td>
                            @endif

                            @if ($student->assessor_score == null)
                                <td class="text-center"><span class="text-danger"><b>Pending Evaluation</b></span></td>
                            @else
                                <td class="text-center">{{ $student->assessor_score }}</td>
                            @endif
                            
                            @if($student->is_evaluated == false)
                                <td class="text-center"><span class="text-danger"><b>Pending Evaluation</b></span></td>
                            @else
                                <td class="text-center">{{ $student->calc_peers_score }}</td>
                            @endif

                            @if ($student->lecturer_score == null || $student->assessor_score == null || $student->is_evaluated == false)
                                <td class="text-center"><span class="text-danger"><b>Pending Evaluation</b></span></td>
                            @else
                                <td class="text-center">{{ $student->total_marks }}</td>
                            @endif
                            
                        </tr>
                    @empty
                        
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection