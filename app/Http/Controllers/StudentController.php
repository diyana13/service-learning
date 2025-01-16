<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\GroupMembers;
use App\Models\Project;
use App\Models\ProjectRegistration;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class StudentController extends Controller
{
    public function index()
    {
        $userId = auth()->id();

        $projects = ProjectRegistration::with('projects')->where('user_id', $userId)->get();
        
        return view('student.student-project', compact('projects'));
    }

    public function search(Request $request)
    {
        try {
            $project_code = $request->project_code;
            $project = Project::with('groups.members')->where('project_code', $project_code)->first();

            if(!$project) {
                return redirect()->route('student.student-project')->with('error', 'Project not found');
            }

            $maxGroupMembers = $project->max_group_members;
            $availableGroups = $project->groups->filter(function ($group) use ($maxGroupMembers) {
                return $group->members->count() < $maxGroupMembers;
            });
        }
        catch (\Exception $e) {
            Log::error('Error searching project: ' . $e->getMessage());
            return redirect()->route('student.student-project')->with('error', 'An error occurred while searching for the project');
        }

        return view('student.register-project', [
            'project' => $project,
            'groups' => $availableGroups,
        ]);
    }

    public function register(Request $request, $id)
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
            $groupMember = new GroupMembers();
            $groupMember->group_id = $group->id;
            $groupMember->student_id = $student->id;
            $groupMember->save();
    
            return redirect()->route('student.student-project')->with('success', 'Project registered successfully');
        } catch (\Exception $e) {
            Log::error('Error registering project: ' . $e->getMessage());
            return redirect()->route('student.student-project')->with('error', 'An error occurred while registering for the project');
        }
    }

    public function show($id)
    {
        $project = Project::findOrFail($id);

        $groups = Group::with('members')->where('project_id', $id)->get();
        
        return view('student.show-project', compact('project', 'groups'));
    }
}
