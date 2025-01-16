@extends('layouts.template-layout')

@section('content')
<div class="col-lg-12">
    <div class="card card-maroon card-outline">
        <div class="card-header">
            <div class="d-flex justify-content-end">
                <a href="{{ route('assessor.project-list') }}" class="btn btn-sm btn-danger"><i class="fa fa-angle-left"></i> Back</a>
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

            <table class="table table-bordered">
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
            </table>

            <div class="row mt-4">
                @forelse ($groups as $group)
                <div class="col-lg-4">
                    <div class="card card-maroon card-outline">
                        <div class="card-header">
                            <div class="card-title">
                                Group {{ $loop->iteration }}
                            </div>

                            <div class="card-tools">
                                @if($group->members->count() == $project->max_group_members && $group->is_assessor_evaluate == 0)
                                    <a href="{{ route('assessor.evaluate', $group->id) }}" class="btn btn-sm btn-warning">
                                        <i class="fa fa-check-square"></i> Evaluate
                                    </a>
                                @elseif($group->is_assessor_evaluate == 1)
                                    <span class="text-success"><i class="fa fa-check"></i> Evaluated</span>
                                @endif
                            </div>
                        </div>
                        <div class="card-body">
                            <ul>
                                @forelse ($group->members as $member)
                                    <li>{{ $member->student->name }}</li>
                                @empty
                                    <li>No student in this group</li>
                                @endforelse
                            </ul>
                        </div>
                    </div>
                </div>
                @empty
                    @for ($i = 0; $i < $project->max_groups; $i++)
                        <div class="col-lg-4">
                            <div class="card card-maroon card-outline">
                                <div class="card-header">
                                    <h5 class="m-0">Group {{ $i + 1 }}</h5>
                                </div>
                                <div class="card-body">
                                    <p class="text-center">No student yet</p>
                                </div>
                            </div>
                        </div>
                    @endfor
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection 