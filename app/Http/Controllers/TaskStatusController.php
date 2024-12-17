<?php

namespace App\Http\Controllers;
use App\Models\TelegramUser;
use App\Models\OfficalTask;
use App\Models\UserTaskStatus;
use Illuminate\Http\Request;

class TaskStatusController extends Controller
{
    //

    public function getTaskStatus()
    {
        $tasksCount = OfficalTask::count(); // Total number of tasks
    
        $status = TelegramUser::all()->map(function ($user) use ($tasksCount) {
            $completedTasks = UserTaskStatus::where('user_id', $user->id)
                ->where('is_verified', true)
                ->count();
    
            $remainingTasks = $tasksCount - $completedTasks;
    
            return [
                'user' => $user->first_name,
                'completed_tasks' => $completedTasks,
                'remaining_tasks' => $remainingTasks,
            ];
        });
    
        return response()->json($status);
    }
    
    
}    
