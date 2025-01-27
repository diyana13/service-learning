<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\PeersAssessment;
use App\Models\Project;
use App\Models\ProjectRegistration;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function lecturerIndex()
    {
        $user = auth()->user();

        $totalProjects = Project::with('lecturer')->where('lecturer_id', $user->id)->count();

        $pendingAssessment = Project::with(['lecturer', 'groups' => function ($query) {
            $query->where('is_lecturer_evaluate', false);
        }])->where('lecturer_id', $user->id)->get();

        $pendingAssessmentCount = $pendingAssessment->map(function ($project) {
            return $project->groups->count();
        })->sum();

        $completedAssessment = Project::with(['lecturer', 'groups' => function ($query) {
            $query->where('is_lecturer_evaluate', true);
        }])->where('lecturer_id', $user->id)->get();

        $completedAssessmentCount = $completedAssessment->map(function ($project) {
            return $project->groups->count();
        })->sum();

        return view('lecturer.home', compact('totalProjects', 'pendingAssessmentCount', 'completedAssessmentCount'));
    }

    public function studentIndex()
    {
        $user = auth()->user();

        // Total Projects
        $totalProjects = ProjectRegistration::where('user_id', $user->id)->count();

        $pendingAssessmentCount = Group::whereHas('members', function ($query) use ($user) {
            $query->where('student_id', $user->id); // Get groups the user is part of
        })->with(['members', 'peersAssessments'])->get()->sum(function ($group) use ($user) {
            // Total peers in the group (excluding the user)
            $totalPeers = $group->members->where('student_id', '!=', $user->id)->count();
    
            // Count peers already evaluated by the user
            $evaluatedPeers = $group->peersAssessments->where('evaluator_id', $user->id)->pluck('evaluatee_id')->unique()->count();
    
            // Pending evaluations for this group
            return $totalPeers - $evaluatedPeers;
        });

        // Completed Assessments
        $completedAssessmentCount = PeersAssessment::where('evaluator_id', $user->id)->count();

        // dd($completedAssessmentCount);

        return view('student.home', compact('totalProjects', 'pendingAssessmentCount', 'completedAssessmentCount'));
    }

    public function assessorIndex()
    {
        $user = auth()->user();

        $totalProjects = ProjectRegistration::where('user_id', $user->id)->count();

        $project = ProjectRegistration::where('user_id', $user->id)->get();

        $pendingAssessment = Group::whereHas('project', function ($query) use ($user) {
            $query->whereHas('registrations', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            });
        })->where('is_assessor_evaluate', false)->get();

        $pendingAssessmentCount = $pendingAssessment->count();

        $completedAssessment = Group::whereHas('project', function ($query) use ($user) {
            $query->whereHas('registrations', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            });
        })->where('is_assessor_evaluate', true)->get();

        $completedAssessmentCount = $pendingAssessment->count();

        return view('assessor.home', compact('totalProjects', 'pendingAssessmentCount', 'completedAssessmentCount'));
    }
}
