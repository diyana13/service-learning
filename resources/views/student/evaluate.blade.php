@extends('layouts.template-layout')

@section('content')
<div class="col-lg-12">
    <div class="card card-warning card-outline">
        <div class="card-header">
            <div class="card-title">
                <h4><b>Evaluation</b></h4>
            </div>
            <div class="card-tools">
                <a href="{{ route('student.show-project', $project->id) }}" class="btn btn-sm btn-danger"><i class="fa fa-angle-left"></i> Back</a>
            </div>
        </div>
        <div class="card-body">
            <h5 class="text-center"><b>Group Member</b></h5>

            <div class="d-flex justify-content-center">
                <table class="table table-bordered w-50">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $groupMember->student->name }}</td>
                            <td>{{ $groupMember->student->email }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <hr>
        
        <form id="evaluate-form" action="{{ route('student.store-evaluation') }}" method="POST">
            @csrf
            <input type="hidden" name="project_id" value="{{ $project->id }}">
            <input type="hidden" name="group_id" value="{{ $groupMember->group_id }}">
            <input type="hidden" name="evaluatee_id" value="{{ $groupMember->student_id }}">

            <div class="card-body">
                <h5 class="text-center"><b>Rubric</b></h5>
                <table class="table table-bordered table-striped">
                    <thead class="text-center">
                        <tr>
                            <th style="width: 250px">Learning Outcome</th>
                            <th>Criteria</th>
                            <th style="width: 100px">Score</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($rubrics as $rubric)
                            @foreach ($rubric->rubric->rubricsCriteria as $index => $criteria)
                                <tr>
                                    @if($index == 0)
                                        <td rowspan="{{ $rubric->rubric->rubricsCriteria->count() }}">{{ $rubric->rubric->rubric_name }}</td>
                                    @endif
                                    <td>
                                        {{ $criteria->criteria_bi }} <br>
                                        <em>
                                            {{ $criteria->criteria_bm }}
                                        </em>
                                    </td>
                                    <td class="text-center align-items-center">
                                        <div class="form-check form-check-inline">
                                            <input required class="form-check-input" type="radio" name="score[{{ $rubric->id }}]" id="score-{{ $rubric->id }}-{{ $criteria->id }}" value="{{ $criteria->score }}">
                                            <label class="form-check-label" for="score-{{ $rubric->id }}-{{ $criteria->id }}">{{ ($index + 1) }}</label>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-sm btn-primary" id="evaluate-button" style="width: 300px;" disabled>Evaluate</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const form = document.getElementById('evaluate-form');
        const evaluateButton = document.getElementById('evaluate-button');
        const radioGroups = {};

        // Group radio buttons by learning outcome
        form.querySelectorAll('input[type="radio"]').forEach(radio => {
            const name = radio.name;
            if (!radioGroups[name]) {
                radioGroups[name] = [];
            }
            radioGroups[name].push(radio);
        });

        function checkRadioButtons() {
            let allChecked = true;
            for (const groupName in radioGroups) {
                const group = radioGroups[groupName];
                const isChecked = group.some(radio => radio.checked);
                if (!isChecked) {
                    allChecked = false;
                    break;
                }
            }
            evaluateButton.disabled = !allChecked;
        }

        // Check radio buttons on page load
        checkRadioButtons();

        // Add event listeners to all radio buttons
        for (const groupName in radioGroups) {
            const group = radioGroups[groupName];
            group.forEach(radio => {
                radio.addEventListener('change', checkRadioButtons);
            });
        }
    });
</script> 
@endpush