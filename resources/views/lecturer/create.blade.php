@extends('layouts.template-layout')

@section('content')
    <div class="col-lg-12">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <div class="d-flex justify-content-end">
                    <a href="{{ route('lecturer.projects') }}" class="btn btn-sm btn-danger"><i class="fa fa-angle-left"></i> Back</a>
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

                <form method="POST" action="{{ route('lecturer.store') }}">
                    @csrf

                    <div class="mb-4">
                        <div class="form-group">
                            <label for="prject_name">Project Name</label>
                            <input type="text" class="form-control" name="project_name"
                                value="{{ old('project_name') }}">
                            @error('project_name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="project_code">Project Code</label>
                            <input type="text" class="form-control" name="project_code"
                                value="{{ $uniqueCode ?? old('project_code') }}" readonly>
                            @error('project_code')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="description">Project Description</label>
                            <textarea class="form-control" name="description">{{ old('description') }}</textarea>
                            @error('description')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-6">
                                    <label for="max_groups">Max No of Group</label>
                                    <input type="number" class="form-control" name="max_groups"
                                        value="{{ old('max_groups') }}">
                                    @error('max_groups')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-6">
                                    <label for="max_group_members">Max No of Group Members</label>
                                    <input type="number" class="form-control" name="max_group_members" min="2"
                                        value="{{ old('max_group_members') }}">
                                    @error('max_group_members')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group mt-4">
                            <div class="alert alert-info mb-3">
                                <i class="fas fa-info-circle"></i> Please select learning outcomes for each role below
                                <p>You have to select 4 learning outcomes for lecturer, 3 for assessor and 3 for student.</p>
                            </div>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th class="text-center">Learning OutCome</th>
                                        <th class="text-center">Lecturer</th>
                                        <th class="text-center">Assessor</th>
                                        <th class="text-center">Student</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($rubrics as $rubric)
                                        <tr>
                                            <td>{{ $rubric->rubric_name }}</td>
                                            <td class="text-center">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" name="lecturer_rubric[]" class="custom-control-input lecturer-checkbox" id="lecturerCheckbox{{ $rubric->id }}" value="{{ $rubric->id }}">
                                                    <label class="custom-control-label" for="lecturerCheckbox{{ $rubric->id }}"></label>
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" name="assessor_rubric[]" class="custom-control-input assessor-checkbox" id="assessorCheckbox{{ $rubric->id }}" value="{{ $rubric->id }}">
                                                    <label class="custom-control-label" for="assessorCheckbox{{ $rubric->id }}"></label>
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" name="student_rubric[]" class="custom-control-input student-checkbox" id="studentCheckbox{{ $rubric->id }}" value="{{ old('student_rubric[]') ?? $rubric->id }}">
                                                    <label class="custom-control-label" for="studentCheckbox{{ $rubric->id }}"></label>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
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

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const minLecturer = 4;
        const maxLecturer = 4;
        const minAssessor = 3;
        const maxAssessor = 3;
        const minStudent = 3;
        const maxStudent = 3;

        const lecturerCheckboxes = document.querySelectorAll('.lecturer-checkbox');
        const assessorCheckboxes = document.querySelectorAll('.assessor-checkbox');
        const studentCheckboxes = document.querySelectorAll('.student-checkbox');
        const submitButton = document.querySelector('form button[type="submit"]');

        function enforceLimit(checkboxes, max) {
            checkboxes.forEach(checkbox => {
                checkbox.addEventListener('change', function () {
                    const checkedCount = Array.from(checkboxes).filter(cb => cb.checked).length;
                    if (checkedCount > max) {
                        this.checked = false;
                        alert(`You can only select up to ${max} checkboxes.`);
                    }
                    validateForm();
                });
            });
        }

        function validateForm() {
            const lecturerCheckedCount = Array.from(lecturerCheckboxes).filter(cb => cb.checked).length;
            const assessorCheckedCount = Array.from(assessorCheckboxes).filter(cb => cb.checked).length;
            const studentCheckedCount = Array.from(studentCheckboxes).filter(cb => cb.checked).length;

            if (lecturerCheckedCount >= minLecturer && assessorCheckedCount >= minAssessor && studentCheckedCount >= minStudent) {
                submitButton.disabled = false;
            } else {
                submitButton.disabled = true;
            }
        }

        function validateOnSubmit() {
            const lecturerCheckedCount = Array.from(lecturerCheckboxes).filter(cb => cb.checked).length;
            const assessorCheckedCount = Array.from(assessorCheckboxes).filter(cb => cb.checked).length;
            const studentCheckedCount = Array.from(studentCheckboxes).filter(cb => cb.checked).length;

            if (lecturerCheckedCount < minLecturer) {
                alert(`You must select at least ${minLecturer} lecturer checkboxes.`);
                return false;
            }

            if (assessorCheckedCount < minAssessor) {
                alert(`You must select at least ${minAssessor} assessor checkboxes.`);
                return false;
            }

            if (studentCheckedCount < minStudent) {
                alert(`You must select at least ${minStudent} student checkboxes.`);
                return false;
            }

            return true;
        }

        enforceLimit(lecturerCheckboxes, maxLecturer);
        enforceLimit(assessorCheckboxes, maxAssessor);
        enforceLimit(studentCheckboxes, maxStudent);

        validateForm(); // Initial validation to disable the button if the rules are not met

        submitButton.addEventListener('click', function (event) {
            if (!validateOnSubmit()) {
                event.preventDefault();
            }
        });
    });
</script>
@endpush
