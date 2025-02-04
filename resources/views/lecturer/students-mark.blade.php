@extends('layouts.template-layout')

@section('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.2.1/css/dataTables.bootstrap4.css">
@endsection

@section('content')
<div class="col-lg-12">
    <div class="card card-maroon card-outline">
        <div class="card-header">
            <div class="card-title">
                Students Mark
            </div>
            <div class="card-tools">
                <a href="{{ route('lecturer.projects') }}" class="btn btn-sm btn-default"><i class="fa fa-angle-left"></i> Back</a>
                &nbsp;
                <a href="{{ route('lecturer.generate-pdf', $project->id) }}" target="_blank" class="btn btn-sm btn-danger"><i class="fa fa-file-pdf"></i></a>
                &nbsp;&nbsp;
            </div>
        </div>
        <div class="card-body">
            <table id="studentMark" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th style="width: 45rem">Student Name</th>
                        <th class="text-center">Lecturer Marks (20%)</th>
                        <th class="text-center">Assessor Marks (15%)</th>
                        <th class="text-center">Peers Marks (15%)</th>
                        <th class="text-center">Total Marks (50%)</th>
                        <th class="text-center" style="width: 20rem;">Feedback from Assessor</th>
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
                            
                            <td class="text-center">{{ $student->assessor_comment }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">No data</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script src="https://cdn.datatables.net/2.2.1/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.2.1/js/dataTables.bootstrap4.js"></script>
    <script>
        let table = new DataTable('#studentMark', {
            language: {
                emptyTable: "No projects available"
            },
            columnDefs: [{
                    orderable: false,
                    targets: [-1]
                } 
            ]
        });
    </script>
@endpush