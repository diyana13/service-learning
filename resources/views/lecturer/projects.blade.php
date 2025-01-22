@extends('layouts.template-layout')

@section('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.2.1/css/dataTables.bootstrap4.css">
@endsection

@section('content')
    <div class="col-lg-12">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <div class="card-title">
                    Project List
                </div>
                <div class="card-tools">
                    <a href="{{ route('lecturer.create') }}" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i>
                        Create</a>
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

                <table id="projectList" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Code</th>
                            <th>Description</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($projects as $project)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $project->project_name }}</td>
                                <td>{{ $project->project_code }}</td>
                                <td>{{ $project->description }}</td>
                                <td>
                                    <a href="{{ route('lecturer.show', $project->id) }}" class="btn btn-sm btn-info"><i
                                            class="fa fa-eye"></i>
                                    </a>
                                    @if (
                                        !$project->groups->contains('is_lecturer_evaluate', 1) &&
                                            !$project->groups->contains('is_assessor_evaluate', 1) &&
                                            !$project->groups->contains('is_peer_evaluate', 1))
                                        <a href="{{ route('lecturer.edit', $project->id) }}"
                                            class="btn btn-sm btn-warning"><i class="fa fa-edit"></i>
                                        </a>
                                    @endif
                                    <a href="{{ route('lecturer.students-mark', $project->id) }}"
                                        class="btn btn-sm btn-primary"><i class="fa fa-clipboard"></i>
                                    </a>
                                    <form action="{{ route('lecturer.destroy', $project->id) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"
                                            onclick="return confirm('Are you sure?')"><i class="fa fa-trash"></i>
                                        </button>
                                    </form>

                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">No data</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Update Project Modal -->
    <div class="modal fade" id="update-modal">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Create Project</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form id="edit-form" method="POST" action="{{ route('lecturer.update', ':id') }}">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="mb-4">
                            <input type="hidden" name="id" id="edit-id">
                            <div class="form-group">
                                <label for="project_name">Name</label>
                                <input type="text" class="form-control" name="project_name" id="edit-project-name">
                                @error('project_name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="project_code">Code</label>
                                <input type="text" class="form-control" name="project_code" id="edit-project-code"
                                    readonly>
                                @error('project_code')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea class="form-control" name="description" id="edit-description"></textarea>
                                @error('description')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-6">
                                        <label for="max_groups">Max No of Group</label>
                                        <input type="number" class="form-control" name="max_groups" id="edit-max-groups"
                                            readonly>
                                        @error('max_groups')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-6">
                                        <label for="max_group_members">Max No of Group Members</label>
                                        <input type="number" class="form-control" name="max_group_members"
                                            id="edit-max-group-members">
                                        @error('max_group_members')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.datatables.net/2.2.1/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.2.1/js/dataTables.bootstrap4.js"></script>
    <script>
        $('#update-modal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            var id = button.data('id');

            var name = button.data('name');
            var code = button.data('code');
            var description = button.data('description');
            var maxGroups = button.data('max-groups');
            var maxGroupMembers = button.data('max-group-members');

            var modal = $(this);
            modal.find('#edit-id').val(id);
            modal.find('#edit-project-name').val(name);
            modal.find('#edit-project-code').val(code);
            modal.find('#edit-description').val(description);
            modal.find('#edit-max-groups').val(maxGroups);
            modal.find('#edit-max-group-members').val(maxGroupMembers);

            // Update the form action with the project id
            var formAction = "{{ route('lecturer.update', ':id') }}";
            formAction = formAction.replace(':id', id);
            modal.find('#edit-form').attr('action', formAction);
        });

        // DataTable
        let table = new DataTable('#projectList', {
            columnDefs: [{
                    orderable: false,
                    targets: [-1]
                } 
            ]
        });
    </script>
@endpush
