<?php

namespace App\Http\Controllers;

use App\Models\TelegramUser;
use App\Models\DailyTask;
use App\Models\TelegramUserDailyTask;
use Illuminate\Http\Request;

class TelegramUserDailyTaskController extends Controller
{
    /**
     * Verify the code or mark the task as completed.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateTaskStatus(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'telegram_user_id' => 'required|exists:telegram_users,id',
            'daily_task_id' => 'required|exists:daily_tasks,id',
            'code' => 'nullable|string', 
        ]);

        $telegramUser = TelegramUser::find($request->telegram_user_id);
        $dailyTask = DailyTask::find($request->daily_task_id);

        // If no code is provided, mark the task as completed when the user submits it
        $telegramUserDailyTask = TelegramUserDailyTask::updateOrCreate(
            [
                'telegram_user_id' => $telegramUser->id,
                'daily_task_id' => $dailyTask->id,
            ],
            ['completed' => true]
        );

        return response()->json([
            'message' => 'Task marked as submitted and completed.',
            'data' => $telegramUserDailyTask,
        ], 200);
    }

}
