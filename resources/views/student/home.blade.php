@extends('layouts.template-layout')

@section('styles')
    <link rel="stylesheet"
        href="{{ asset('template') }}/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
@endsection

@section('content')
<div class="col-lg-12">
    <div class="card card-maroon card-outline">
        <div class="card-header">
            <h5 class="m-0">Welcome, {{ Auth::user()->name }}</h5>
        </div>
        <div class="card-body">
            <h6 class="card-title">Peer Assessment Hub</h6>

            <p class="card-text">Review and evaluate your peers' work. Track group assessment progress and feedback.</p>
            <a href="{{ route('student.student-project') }}" class="btn btn-danger">Go to projects</a>
        </div>
    </div>
</div>
<!-- New Summary Section -->
<div class="col-lg-12">
    <div class="row">
        <div class="col-lg-12">
            <div class="row ">
                <!-- Total Projects -->
                <div class="col-md-4">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{ $totalProjects ?? 0 }}</h3>

                            <p>Total Projects</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-tasks"></i>
                        </div>
                    </div>
                </div>
                <!-- Pending Assessments -->
                <div class="col-md-4">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{ $pendingAssessmentCount ?? 0 }}</h3>

                            <p>Pending Evaluations</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-hourglass-half"></i>
                        </div>
                    </div>
                </div>
                <!-- Completed Assessments -->
                <div class="col-md-4">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{ $completedAssessmentCount ?? 0 }}</h3>

                            <p>Completed Evaluations</p>
                        </div>
                        <div class="icon">
                            {{-- <i class="fas fa-chart-pie"></i> --}}
                            <i class="fa fa-check"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <!-- Calendar -->
            <div class="card bg-gradient-maroon">
                <div class="card-header border-0">

                    <h3 class="card-title">
                        <i class="far fa-calendar-alt"></i>
                        Calendar
                    </h3>
                    <!-- tools card -->
                    <div class="card-tools">
                        <!-- button with a dropdown -->
                        <div class="btn-group">
                            <button type="button" class="btn btn-maroon btn-sm dropdown-toggle" data-toggle="dropdown"
                                data-offset="-52">
                                <i class="fas fa-bars"></i>
                            </button>
                            <div class="dropdown-menu" role="menu">
                                <a href="#" class="dropdown-item">Add new event</a>
                                <a href="#" class="dropdown-item">Clear events</a>
                                <div class="dropdown-divider"></div>
                                <a href="#" class="dropdown-item">View calendar</a>
                            </div>
                        </div>
                        <button type="button" class="btn btn-maroon btn-sm" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                        {{-- <button type="button" class="btn btn-maroon btn-sm" data-card-widget="remove">
                            <i class="fas fa-times"></i>
                        </button> --}}
                    </div>
                    <!-- /. tools -->
                </div>
                <!-- /.card-header -->
                <div class="card-body pt-0">
                    <!--The calendar -->
                    <div id="calendar" style="width: 100%"></div>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script src="{{ asset('template') }}/plugins/moment/moment.min.js"></script>
    <script src="{{ asset('template') }}/plugins/daterangepicker/daterangepicker.js"></script>
    <script src="{{ asset('template') }}/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
    <script>
        // The Calender
        $('#calendar').datetimepicker({
            format: 'L',
            inline: true
        })
    </script>
@endpush