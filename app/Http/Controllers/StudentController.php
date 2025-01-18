<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\GroupMembers;
use App\Models\PeersAssessment;
use App\Models\Project;
use App\Models\ProjectRegistration;
use App\Models\ProjectRubric;
use App\Models\StudentMark;
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

            if (!$project) {
                return redirect()->route('student.student-project')->with('error', 'Project not found');
            }

            $maxGroupMembers = $project->max_group_members;
            $availableGroups = $project->groups->filter(function ($group) use ($maxGroupMembers) {
                return $group->members->count() < $maxGroupMembers;
            });
        } catch (\Exception $e) {
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

            // Create row in student_marks
            $studentMark = new StudentMark();
            $studentMark->student_id = auth()->id();
            $studentMark->project_id = $project->id;
            $studentMark->save();

            return redirect()->route('student.student-project')->with('success', 'Project registered successfully');
        } catch (\Exception $e) {
            Log::error('Error registering project: ' . $e->getMessage());
            return redirect()->route('student.student-project')->with('error', 'An error occurred while registering for the project');
        }
    }

    public function show($id)
    {
        $project = Project::findOrFail($id); // Fetch the project by its ID

        // Get the authenticated student
        $student = auth()->user();

        // Find the group that the student belongs to for this project
        $group = Group::where('project_id', $id)
            ->whereHas('members', function ($query) use ($student) {
                $query->where('student_id', $student->id); // Filter by the current student
            })
            ->first();

        if ($group) {
            // Fetch all group members of the student's group
            $groupMembers = GroupMembers::where('group_id', $group->id)
                ->with('student') // Eager load student details
                ->get();

            $where = [];
            $where['project_id'] = $project->id;
            $where['group_id'] = $group->id;
            // $where['evaluatee_id'] = $groupMembers->student_id;

            $groupMembers = $groupMembers->map(function ($data) use ($project, $where) {
                $totalPeerAssessed = PeersAssessment::where($where)
                    ->where('evaluatee_id', $data->student_id)
                    ->count();

                if($totalPeerAssessed == $project->max_group_members - 1) {
                    $data->is_evaluated = true;
                }
                else {
                    $data->is_evaluated = false;
                }

                $isEvaluatedByStudent = PeersAssessment::where($where)
                    ->where('evaluator_id', auth()->id())
                    ->where('evaluatee_id', $data->student_id)
                    ->count();

                if($isEvaluatedByStudent == 1) {
                    $data->is_evaluated_by_student = true;
                }
                else {
                    $data->is_evaluated_by_student = false;
                }
                return $data;
            });

            // dd($groupMembers);
        }

        return view('student.show-project', compact('project', 'groupMembers'));
    }

    public function evaluate($projectId, $groupId, $memberId)
    {
        $groupMember = GroupMembers::with('student')
            ->where('group_id', $groupId)
            ->where('student_id', $memberId)
            ->first();

        $project = Project::findOrFail($projectId);
        $rubrics = ProjectRubric::where('project_id', $projectId)
            ->where('role', 'student')
            ->with('rubric.rubricsCriteria')
            ->get();

        return view('student.evaluate', compact('project', 'groupMember', 'rubrics'));
    }

    public function storeEvaluation(Request $request)
    {
        try {
            $totalMarks = 0;
            foreach ($request->score as $score) {
                $totalMarks += $score;
            }

            $peerAssessment = new PeersAssessment();
            $peerAssessment->project_id = $request->project_id;
            $peerAssessment->group_id = $request->group_id;
            $peerAssessment->evaluator_id = auth()->id();
            $peerAssessment->evaluatee_id = $request->evaluatee_id;
            $peerAssessment->score = $totalMarks;
            $peerAssessment->save();

            $group = Group::where('id', $request->group_id)->first();
            $group->is_peer_evaluate = true;
            $group->save();

            // Update data in group_members table
            $groupMember = GroupMembers::where('group_id', $request->group_id)
                ->where('student_id', $request->evaluatee_id)
                ->first();

            // $groupMember->is_evaluated = true;
            // $groupMember->save();

            // Search student_mark table
            $studentMark = StudentMark::where('student_id', $request->evaluatee_id)
                ->where('project_id', $request->project_id)
                ->first();

            $currentScore = $studentMark->peers_score ? $studentMark->peers_score : 0;
            $updatedScore = $currentScore + $totalMarks;
            $studentMark->peers_score = $updatedScore;
            $studentMark->save();
        } catch (\Exception $e) {
            Log::error('Error storing evaluation: ' . $e->getMessage());
            return redirect()->route('student.show-project', $request->project_id)->with('error', 'An error occurred while storing the evaluation');
        }

        return redirect()->route('student.show-project', $request->project_id)->with('success', 'Evaluation stored successfully');
    }
}
