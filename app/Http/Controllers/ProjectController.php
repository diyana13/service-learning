<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Project;
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

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $uniqueCode = $this->generateUniqueCode();
        return view('lecturer.create', compact('uniqueCode'));
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
            'mark_lecturer' => 'required|integer',
            'mark_student' => 'required|integer',
            'mark_assessor' => 'required|integer',
        ]);
        try {
            $store = new Project();
            $store->project_name = $request->project_name;
            $store->project_code = $request->project_code;
            $store->description = $request->description;
            $store->max_groups = $request->max_groups;
            $store->max_group_members = $request->max_group_members;
            $store->mark_lecturer = $request->mark_lecturer;
            $store->mark_student = $request->mark_student;
            $store->mark_assessor = $request->mark_assessor;
            $store->lecturer_id = auth()->id();
            $store->save();


            for ($i = 0; $i < $request->max_groups; $i++) {
                $group = new Group();
                $group->project_id = $store->id;
                $group->save();
            }
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('lecturer.create')->with('error', 'Project unable to create');
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
            'max_groups' => 'required|integer',
            'max_group_members' => 'required|integer',
            'mark_lecturer' => 'required|integer',
            'mark_student' => 'required|integer',
            'mark_assessor' => 'required|integer',
        ]);
        try {
            $update->project_name = $request->project_name;
            $update->project_code = $request->project_code;
            $update->description = $request->description;
            $update->max_groups = $request->max_groups;
            $update->max_group_members = $request->max_group_members;
            $update->mark_lecturer = $request->mark_lecturer;
            $update->mark_student = $request->mark_student;
            $update->mark_assessor = $request->mark_assessor;
            $update->lecturer_id = auth()->id();
            $update->save();
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('lecturer.edit', $id)->with('error', 'Project unable to update');
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

        $student = User::findOrFail($userId);

        $projects = $student->groupMember()
                            ->with('group.project')
                            ->get()
                            ->pluck('group.project')
                            ->unique();
        
        // dd($projects);
        return view('student.student-project', compact('projects'));
    }

    public function searchProject(Request $request)
    {
        $project_code = $request->project_code;
        $project = Project::with('groups.members')->where('project_code', $project_code)->first();

        // Filter groups that have not reached their maximum capacity
        $maxGroupMembers = $project->max_group_members;
        $availableGroups = $project->groups->filter(function ($group) use ($maxGroupMembers) {
            return $group->members->count() < $maxGroupMembers;
        });

        // dd($availableGroups);

        return view('student.register-project', [
            'project' => $project,
            'groups' => $availableGroups,
        ]);
    }

    public function registerProject(Request $request, $id)
    {
        $project = Project::findOrFail($id);

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
        $group->members()->create([
            'student_id' => auth()->id(),
        ]);

        return redirect()->route('student.student-project')->with('success', 'Project registered successfully');
    }
}
