<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TelegramUserTask;
use App\Models\Task;

class TelegramUserTaskController extends Controller
{
    //
    public function submitTask(Request $request)
    {
        $request->validate([
            'telegram_user_id' => 'required|exists:telegram_users,id',
            'task_id' => 'required|exists:tasks,id',
            'code' => 'nullable|string',
        ]);

        $telegramUserId = $request->telegram_user_id;
        $taskId = $request->task_id;
        $code = $request->code;

        // Find the task
        $task = Task::findOrFail($taskId);

        // Find or create the telegram_user_task record
        $telegramUserTask = TelegramUserTask::firstOrNew([
            'telegram_user_id' => $telegramUserId,
            'task_id' => $taskId,
        ]);

        if ($task->type === 'code') {
            // If the task type is 'code', validate the code
            if ($task->code && $task->code === $code) {
                $telegramUserTask->is_submitted = true;
                $telegramUserTask->submitted_at = now();
                $telegramUserTask->save();

                return response()->json([
                    'message' => 'Code verified and task marked as submitted.',
                ], 200);
            } else {
                return response()->json([
                    'message' => 'Invalid code provided.',
                ], 400);
            }
        } else {
            // For other task types, mark as submitted
            $telegramUserTask->is_submitted = true;
            $telegramUserTask->submitted_at = now();
            $telegramUserTask->save();

            return response()->json([
                'message' => 'Task marked as submitted.',
            ], 200);
        }
    }
}
