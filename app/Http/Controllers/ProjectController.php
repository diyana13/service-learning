<?php

namespace App\Http\Controllers;

use App\Models\Assessment;
use App\Models\Group;
use App\Models\GroupMembers;
use App\Models\Project;
use App\Models\ProjectRegistration;
use App\Models\ProjectRubric;
use App\Models\Rubrics;
use App\Models\StudentMark;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::with('groups.members')
            ->whereHas('lecturer', function ($query) {
                $query->where('id', auth()->id());
            })->get();

        return view('lecturer.projects', compact('projects'));
    }

    public function create()
    {
        $uniqueCode = $this->generateUniqueCode();
        $rubrics = Rubrics::all();

        return view('lecturer.create', compact('uniqueCode', 'rubrics'));
    }

    private function generateUniqueCode()
    {
        do {
            $code = Str::upper(Str::random(2)) . rand(1000, 9999);
        } while (Project::where('project_code', $code)->exists());

        return $code;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'project_name' => 'required|string|max:255',
            'project_code' => 'required|string|max:255|unique:projects',
            'description' => 'required',
            'max_groups' => 'required|integer',
            'max_group_members' => 'required|integer',
            'lecturer_rubric' => 'required|array|max:4',
            'student_rubric' => 'required|array|max:3',
            'assessor_rubric' => 'required|array|max:3',
        ]);
        try {
            $store = new Project();
            $store->project_name = $request->project_name;
            $store->project_code = $request->project_code;
            $store->description = $request->description;
            $store->max_groups = $request->max_groups;
            $store->max_group_members = $request->max_group_members;
            $store->lecturer_id = auth()->id();
            $store->save();

            for ($i = 0; $i < $request->max_groups; $i++) {
                $group = new Group();
                $group->project_id = $store->id;
                $group->group_number = "Group " . ($i + 1);
                $group->save();
            }

            $rubricData = [];

            if ($request->lecturer_rubric) {
                foreach ($request->lecturer_rubric as $rubricId) {
                    $rubricData[] = [
                        'project_id' => $store->id,
                        'rubric_id' => $rubricId,
                        'role' => 'lecturer',
                    ];
                }
            }

            if ($request->student_rubric) {
                foreach ($request->student_rubric as $rubricId) {
                    $rubricData[] = [
                        'project_id' => $store->id,
                        'rubric_id' => $rubricId,
                        'role' => 'student',
                    ];
                }
            }

            if ($request->assessor_rubric) {
                foreach ($request->assessor_rubric as $rubricId) {
                    $rubricData[] = [
                        'project_id' => $store->id,
                        'rubric_id' => $rubricId,
                        'role' => 'assessor',
                    ];
                }
            }

            ProjectRubric::insert($rubricData);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('lecturer.projects')->with('error', 'Project unable to create');
        }
        return redirect()->route('lecturer.projects')->with('success', 'Project created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $project = Project::findOrFail($id);

        $groups = Group::with('members.student')->where('project_id', $id)->get();
        // dd($groups);
        return view('lecturer.show', compact('project', 'groups'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $project = Project::findOrFail($id);
        $rubrics = Rubrics::all();
        $chosenLecturerRubrics = $project->projectRubrics()->where('role', 'lecturer')->pluck('rubric_id')->toArray();
        $chosenAssessorRubrics = $project->projectRubrics()->where('role', 'assessor')->pluck('rubric_id')->toArray();
        $chosenStudentRubrics = $project->projectRubrics()->where('role', 'student')->pluck('rubric_id')->toArray();

        return view('lecturer.edit', compact('project', 'rubrics', 'chosenLecturerRubrics', 'chosenAssessorRubrics', 'chosenStudentRubrics'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $update = Project::findOrFail($id);
        $request->validate([
            'project_name' => 'required|string|max:255',
            'project_code' => 'required|string|max:255|unique:projects,project_code,' . $id,
            'description' => 'required',
            'max_group_members' => 'required|integer',
            'lecturer_rubric' => 'required|array|max:4',
            'student_rubric' => 'required|array|max:3',
            'assessor_rubric' => 'required|array|max:3',
        ]);
        try {
            $update->project_name = $request->project_name;
            $update->project_code = $request->project_code;
            $update->description = $request->description;
            $update->max_group_members = $request->max_group_members;
            $update->lecturer_id = auth()->id();
            $update->save();

            // Delete existing ProjectRubric records for the project
            ProjectRubric::where('project_id', $update->id)->delete();

            // Prepare the new ProjectRubric data
            $rubricData = [];

            if ($request->lecturer_rubric) {
                foreach ($request->lecturer_rubric as $rubricId) {
                    $rubricData[] = [
                        'project_id' => $update->id,
                        'rubric_id' => $rubricId,
                        'role' => 'lecturer',
                    ];
                }
            }

            if ($request->student_rubric) {
                foreach ($request->student_rubric as $rubricId) {
                    $rubricData[] = [
                        'project_id' => $update->id,
                        'rubric_id' => $rubricId,
                        'role' => 'student',
                    ];
                }
            }

            if ($request->assessor_rubric) {
                foreach ($request->assessor_rubric as $rubricId) {
                    $rubricData[] = [
                        'project_id' => $update->id,
                        'rubric_id' => $rubricId,
                        'role' => 'assessor',
                    ];
                }
            }

            // Insert the new ProjectRubric records
            ProjectRubric::insert($rubricData);

        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('lecturer.projects', $id)->with('error', 'Project unable to update');
        }
        return redirect()->route('lecturer.projects')->with('success', 'Project updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $destroy = Project::findOrFail($id);
            $destroy->delete();
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('lecturer.projects')->with('error', 'Project unable to delete');
        }
        return redirect()->route('lecturer.projects')->with('success', 'Project deleted successfully');
    }

    public function evaluate($id)
    {
        $group = Group::findOrFail($id);
        $project = $group->project;
        $projectID = $project->id;
        $rubrics = ProjectRubric::where('project_id', $projectID)
            ->where('role', 'lecturer')
            ->with('rubric.rubricsCriteria')
            ->get();

        return view('lecturer.evaluate', compact('group', 'rubrics', 'projectID'));
    }

    public function storeEvaluate(Request $request, $id)
    {
        $group = Group::findOrFail($id);
        $project = $group->project;

        $totalMarks = 0;
        foreach ($request->score as $score) {
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

            $group->is_lecturer_evaluate = true;
            $group->save();

            foreach ($group->members as $member) {
                StudentMark::updateOrCreate(
                    [
                        'student_id' => $member->student_id,
                        'project_id' => $project->id,
                    ],
                    [
                        'lecturer_score' => $totalMarks,
                    ]
                );
            }
        } catch (\Exception $e) {
            Log::error('Error evaluating group: ' . $e->getMessage());
            return redirect()->route('lecturer.show', $project->id)->with('error', 'An error occurred while evaluating the group');
        }

        return redirect()->route('lecturer.show', $project->id)->with('success', 'Group evaluated successfully');
    }

    public function studentsMark($id)
    {
        // $project = Project::findOrFail($id);

        $studentsMarks = StudentMark::where('project_id', $id)
            ->with('student')
            ->get();

        return view('lecturer.students-mark', compact('studentsMarks'));
    }
}
