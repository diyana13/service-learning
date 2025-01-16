<?php

namespace App\Http\Controllers;

use App\Models\Assessment;
use App\Models\Group;
use App\Models\Project;
use App\Models\ProjectRegistration;
use App\Models\ProjectRubric;
use App\Models\StudentMark;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AssessorController extends Controller
{
    public function index()
    {
        $userId = auth()->id();
        $projects = ProjectRegistration::with('projects')->where('user_id', $userId)->get();
        
        // dd($projects);
        return view('assessor.project-list', compact('projects'));
    }

    public function search(Request $request)
    {
        $project_code = $request->project_code;
        $project = Project::with('groups.members')->where('project_code', $project_code)->first();

        return view('assessor.register-project', compact('project'));
    }

    public function register($id)
    {
        $project = Project::findOrFail($id);

        try {
            $userId = auth()->id();

            $registration = ProjectRegistration::where('user_id', $userId)
                ->where('project_id', $project->id)
                ->first();

            if ($registration) {
                return redirect()->route('assessor.project-list')->with('error', 'You have already registered for this project');
            }

            $register = new ProjectRegistration();
            $register->project_id = $project->id;
            $register->user_id = $userId;
            $register->save();
        }
        catch (\Exception $e) {
            Log::error('Error registering project: ' . $e->getMessage());
            return redirect()->route('assessor.project-list')->with('error', 'An error occurred while registering for the project');
        }

        return redirect()->route('assessor.project-list')->with('success', 'Project registered successfully');
    }

    public function show($id)
    {
        $project = Project::findOrFail($id);
        $groups = Group::with('members.student')->where('project_id', $id)->get();
        
        return view('assessor.show-project', compact('project', 'groups'));
    }

    public function evaluate($id) 
    {
        $group = Group::findOrFail($id);
        $project = $group->project;
        $projectID = $project->id;
        $rubrics = ProjectRubric::where('project_id', $projectID)
            ->where('role', 'assessor')
            ->with('rubric.rubricsCriteria')
            ->get();
        
        return view('assessor.evaluate', compact('group', 'rubrics', 'projectID'));
    }

    public function storeEvaluate(Request $request, $id) 
    {
        $group = Group::findOrFail($id);
        $project = $group->project;

        $totalMarks = 0;
        foreach($request->score as $score) {
            $totalMarks += $score;
        }

        try {
            $store = new Assessment();
            $store->project_id = $project->id;
            $store->group_id = $group->id;
            $store->assessor_id = auth()->id();
            $store->score = $totalMarks;
            $store->comment = $request->comment;
            $store->save();

            $group->is_assessor_evaluate = true;
            $group->save();

            foreach ($group->members as $member) {
                StudentMark::updateOrCreate(
                    [
                        'student_id' => $member->student_id,
                        'project_id' => $project->id,
                    ],
                    [
                        'assessor_score' => $totalMarks,
                    ]
                );
            }
        }
        catch (\Exception $e) {
            Log::error('Error evaluating group: ' . $e->getMessage());
            return redirect()->route('assessor.show-project', $id)->with('error', 'An error occurred while evaluating the group');
        }

        return redirect()->route('assessor.show-project', $id)->with('success', 'Group evaluated successfully');
    }
}
