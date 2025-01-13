<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Project;
use App\Models\ProjectRegistration;
use App\Models\ProjectRubric;
use App\Models\Rubrics;
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
        $projects = Project::whereHas('lecturer', function ($query) {
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

            if($request->lecturer_rubric) {
                foreach($request->lecturer_rubric as $rubricId) {
                    $rubricData[] = [
                        'project_id' => $store->id,
                        'rubric_id' => $rubricId,
                        'role' => 'lecturer',
                    ];
                }
            }

            if($request->student_rubric) {
                foreach($request->student_rubric as $rubricId) {
                    $rubricData[] = [
                        'project_id' => $store->id,
                        'rubric_id' => $rubricId,
                        'role' => 'student',
                    ];
                }
            }

            if($request->assessor_rubric) {
                foreach($request->assessor_rubric as $rubricId) {
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
        return view('lecturer.edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $update = Project::findOrFail($id);
        $request->validate([
            'project_name' => 'required|string|max:255',
            'project_code' => 'required|string|max:255|unique:projects,project_code,' . $id,
            'description' => 'required',
            'max_group_members' => 'required|integer',
        ]);
        try {
            $update->project_name = $request->project_name;
            $update->project_code = $request->project_code;
            $update->description = $request->description;
            $update->max_group_members = $request->max_group_members;
            $update->lecturer_id = auth()->id();
            $update->save();
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

    // for student project that student involved
    public function studentProject()
    {
        $userId = auth()->id();

        $projects = ProjectRegistration::with('projects')->where('user_id', $userId)->get();
        
        return view('student.student-project', compact('projects'));
    }

    public function searchProject(Request $request)
    {
        $project_code = $request->project_code;
        $project = Project::with('groups.members')->where('project_code', $project_code)->first();

        $maxGroupMembers = $project->max_group_members;
        $availableGroups = $project->groups->filter(function ($group) use ($maxGroupMembers) {
            return $group->members->count() < $maxGroupMembers;
        });

        return view('student.register-project', [
            'project' => $project,
            'groups' => $availableGroups,
        ]);
    }

    public function registerProject(Request $request, $id)
    {
        try {
            $project = Project::findOrFail($id);
    
            // Check if the student has already registered for the project
            $userId = auth()->id();
            $student = User::findOrFail($userId);
            $registration = ProjectRegistration::where('user_id', $student->id)
                ->where('project_id', $project->id)
                ->first();
    
            if ($registration) {
                return redirect()->route('student.student-project')->with('error', 'You have already registered for this project');
            }
    
            // Register the student for the project
            $register = new ProjectRegistration();
            $register->project_id = $project->id;
            $register->user_id = $student->id;
            $register->save();
    
            // Find the chosen group
            $group = Group::findOrFail($request->group_id);
    
            // Check if the group belongs to the project
            if ($group->project_id != $project->id) {
                return redirect()->route('student.student-project')->with('error', 'Invalid group selection');
            }
    
            // Check if the group has reached the maximum number of members
            if ($group->members->count() >= $project->max_group_members) {
                return redirect()->route('student.student-project')->with('error', 'Group is full');
            }
    
            // Add the student to the group
            $group->members()->attach($student->id);
    
            return redirect()->route('student.student-project')->with('success', 'Project registered successfully');
        } catch (\Exception $e) {
            Log::error('Error registering project: ' . $e->getMessage());
            return redirect()->route('student.student-project')->with('error', 'An error occurred while registering for the project');
        }
    }

    public function showStudent($id)
    {
        $project = Project::findOrFail($id);

        $groups = Group::with('members')->where('project_id', $id)->get();
        
        return view('student.show-project', compact('project', 'groups'));
    }

    public function ProjectList()
    {

        $userId = auth()->id();

        $projects = ProjectRegistration::with('projects')->where('user_id', $userId)->get();
        
        // dd($projects);
        return view('assessor.project-list', compact('projects'));
    }

    public function searchAssessor(Request $request)
    {
        $project_code = $request->project_code;
        $project = Project::with('groups.members')->where('project_code', $project_code)->first();

        return view('assessor.register-project', compact('project'));
    }

    public function ProjectAssessor($id)
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

    public function showAssessor($id)
    {
        $project = Project::findOrFail($id);

        $groups = Group::with('members.student')->where('project_id', $id)->get();
        // dd($groups);
        return view('assessor.show-project', compact('project', 'groups'));
    }


}
