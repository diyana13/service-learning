@extends('layouts.template-layout')

@section('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.2.1/css/dataTables.bootstrap4.css">
@endsection

@section('content')
<div class="col-lg-12">
    <div class="card card-maroon card-outline">
        <div class="card-header">
            <div class="d-flex justify-content-end">
                <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-sm">
                    <i class="fa fa-plus"></i> Register Project
                </button>
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
                        <td>{{ $project->projects->project_name }}</td>
                        <td>{{ $project->projects->project_code }}</td>
                        <td>{{ $project->projects->description }}</td>
                        <td>
                            <a href="{{ route('assessor.show-project', $project->projects->id) }}" class="btn btn-sm btn-info"><i class="fa fa-eye"></i></a>
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

<div class="modal fade" id="modal-sm">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Search Project</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('assessor.search-project') }}">
                    @csrf

                    <div class="form-group">
                        <label for="project_code">Enter project code:</label>
                        <div class="input-group mb-3">
                            <input type="text" name="project_code" class="form-control">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-info"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer justify-content-end">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
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
        let table = new DataTable('#projectList', {
            columnDefs: [{
                    orderable: false,
                    targets: [-1]
                } 
            ]
        });
    </script>
@endpush