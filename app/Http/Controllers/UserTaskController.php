<?php

namespace App\Http\Controllers;

use App\Models\OfficalTask;
use App\Models\UserTaskStatus;
use App\Models\Task;
use Illuminate\Http\Request;

class UserTaskController extends Controller
{

    public function index()
    {
        // Retrieve all tasks from the Task model
        $tasks = Task::all();
    
        // Return the data as JSON
        return response()->json([
            'success' => true,
            'data' => $tasks,
        ], 200);
    }
    public function verifyTask(Request $request, $id)
    {
        // Validate the code
        $validated = $request->validate([
            'code' => 'required|string',
        ]);

        // Find the task
        $task = OfficalTask::findOrFail($id);

        // Check if the user exists (assuming user is authenticated)
        $user = $request->user();

        if (!$user) {
            return response()->json([
                'message' => 'User not found.',
            ], 404);
        }

        // Verify the task code
        if ($task->code === $validated['code']) {
            // Create or update the user-task status
            $status = UserTaskStatus::updateOrCreate(
                [
                    'user_id' => $user->id,
                    'task_id' => $task->id,
                ],
                ['is_verified' => true] // Set the verification status to true
            );

            return response()->json([
                'message' => 'Code verified successfully.',
                'task' => $task,
                'status' => $status,
            ]);
        }

        return response()->json([
            'message' => 'Invalid code.',
        ], 400);
    }


}
