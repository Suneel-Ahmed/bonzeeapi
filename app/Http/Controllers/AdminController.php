<?php

namespace App\Http\Controllers;

use App\Models\TelegramUser;
use App\Models\Task;
use App\Models\DailyTask;
use App\Models\Mission;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $userCount = TelegramUser::count();
        $taskCount = Task::count();
        $dailyTaskCount = DailyTask::count();
        return view('dashboard', compact('userCount', 'taskCount', 'dailyTaskCount'));
    }

    public function users()
    {
        $users = TelegramUser::all();
        return view('users', compact('users'));
    }
    public function missions()
    {
        $mission = Mission::all();
        return view('missions', compact('mission'));
    }

    public function createMissions()
    {
        return view('create_mission');
    }


 // Store Offical 


    public function storeMissions(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'link' => 'required|string',
            'code' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('storage/images/missions'), $imageName); // Save to storage/app/public/images/missions

            // Add the image path to the validated data
            $validated['image'] = '/images/missions/' . $imageName;
        }

        // Save data to the database
        Mission::create($validated);

        return redirect()->route('missions')->with('success', 'Official task created successfully');
    }



// Delete Offical 

public function deleteMission($id)
{
    $mission = Mission::findOrFail($id);

    // Manually delete related records
    foreach ($mission->levels as $level) {
        // Delete related TelegramUserMissions
        $level->telegramUserMissions()->delete();
    }

    // Delete all MissionLevels
    $mission->levels()->delete();

    // Delete the Mission
    $mission->delete();

    return redirect()->route('missions')->with('success', 'Mission deleted successfully');
}


// Update Mission 

public function updateMission(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'link' => 'required|string',
            'code' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
        ]);

        $mission = Mission::findOrFail($id);

        if ($request->hasFile('image')) {
            // Delete the old image if it exists
            if ($mission->image && file_exists(public_path($mission->image))) {
                unlink(public_path($mission->image));
            }

            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images/missions'), $imageName);

            $validated['image'] = 'images/missions/' . $imageName;
        }

        $mission->update($validated);

        return redirect()->route('missions')->with('success', 'Mission updated successfully');
    }

    public function tasks()
    {
        $tasks = Task::all();
        return view('tasks', compact('tasks'));
    }

    public function createTask()
    {
        return view('create_task');
    }

    public function storeTask(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'reward_coins' => 'required|integer|min:1',
        ]);

        Task::create($validated);

        return redirect()->route('tasks')->with('success', 'Task created successfully');
    }

    public function dailyTasks()
    {
        $dailyTasks = DailyTask::all();
        return view('daily_tasks', compact('dailyTasks'));
    }

    public function createDailyTask()
    {
        return view('create_daily_task');
    }

    public function storeDailyTask(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'required_login_streak' => 'required|integer|min:1|max:10',
            'reward_coins' => 'required|integer|min:1',
        ]);

        DailyTask::create($validated);

        return redirect()->route('daily_tasks')->with('success', 'Daily task created successfully');
    }

    public function editTask(Task $task)
    {
        return view('tasks.edit', compact('task'));
    }

    public function updateTask(Request $request, Task $task)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'required_taps' => 'required|integer|min:0',
            'reward_coins' => 'required|integer|min:1',
        ]);

        $task->update($validated);

        return redirect()->route('tasks')->with('success', 'Task updated successfully');
    }

    public function deleteTask(Task $task)
    {
        $task->delete();
        return redirect()->route('tasks')->with('success', 'Task deleted successfully');
    }

    public function editDailyTask(DailyTask $dailyTask)
    {
        return view('daily_tasks.edit', compact('dailyTask'));
    }

    public function updateDailyTask(Request $request, DailyTask $dailyTask)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'required_login_streak' => 'required|integer|min:1|max:10',
            'reward_coins' => 'required|integer|min:1',
        ]);

        $dailyTask->update($validated);

        return redirect()->route('daily_tasks')->with('success', 'Daily task updated successfully');
    }

    public function deleteDailyTask(DailyTask $dailyTask)
    {
        $dailyTask->delete();
        return redirect()->route('daily_tasks')->with('success', 'Daily task deleted successfully');
    }
}