<?php

namespace App\Http\Controllers;

use App\Models\TelegramUser;
use App\Models\Task;
use App\Models\DailyTask;
use App\Models\Offical_partnersModel;
use App\Models\OfficalTask;
use App\Models\TelegramUserTask;
use App\Models\UserTaskStatus;
use App\Models\PaymentMethod;
use App\Models\PaymentMethodLock;
use App\Models\TelegramUserDailyTask;


use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $userCount = TelegramUser::count();
        $taskCount = Task::count();
        $dailyTaskCount = DailyTask::count();
        $officalTask = OfficalTask::count();
        $lockStatus = PaymentMethodLock::get();
        return view('dashboard', compact('userCount', 'taskCount', 'dailyTaskCount' , 'officalTask' , 'lockStatus'));
    }

 

    public function users(Request $request)
    {
        $query  = TelegramUser::query();
        $sort = $request->input('sort');
        switch ($sort) {
            case 'newest':
                $query->orderBy('created_at', 'desc');
                break;
            case 'oldest':
                $query->orderBy('created_at', 'asc');
                break;
            case 'high_balance':
                $query->orderBy('balance', 'desc');
                break;
            case 'low_balance':
                $query->orderBy('balance', 'asc');
                break;
            default:
                $query->orderBy('id', 'asc'); // Default sorting
                break;
        }

        $users = $query->get();
        return view('users', compact('users'));
    }

    public function eachUser($user_id)
    {
        // Find the user by ID
        $user = TelegramUser::findOrFail($user_id);
        $tasksCount = OfficalTask::count();
        $allTasksCount = Task::count();
        $dailyTasks = DailyTask::count();
        $completedTasks = UserTaskStatus::where('user_id', $user_id)->count();
        // Return the view with the user data
        $remainingTasks = $tasksCount - $completedTasks;
        $tasksStatus = [
            'all_tasks' => $tasksCount,
            'remaining_tasks' => $remainingTasks,
            'completed_tasks' => $completedTasks,
        ];
        $submittedTasksCount = TelegramUserTask::where('telegram_user_id', $user_id)
        ->where('is_submitted', true)
        ->count();
        // PaymentMethod
        $paymentMethods = PaymentMethod::get();
        if ($paymentMethods->isEmpty()) {
            return response()->json(['success' => false, 'message' => 'No payment methods found'], 404);
        }
        // $paymentMethods = $user->paymentMethods;
        $completedDailyTasks = TelegramUserDailyTask::where('telegram_user_id', $user_id)
        ->where('completed', true)
        ->count();


        $remainingDailyTasks = $dailyTasks - $completedDailyTasks;
        $remainTasks = $allTasksCount - $submittedTasksCount;
        
        $earnTasks = [
            'all_tasks' => $allTasksCount,
            'completed_tasks' => $submittedTasksCount,
            'remaining_tasks' => $remainTasks,
        ];



        $dailytasksStatus = [
            'all_tasks' => $dailyTasks,
            'remaining_tasks' => $remainingDailyTasks,
            'completed_tasks' => $completedDailyTasks,
        ];

        return view('each_user_view', compact('user' , 'tasksStatus' , 'earnTasks' , 'dailytasksStatus' , 'paymentMethods' ));
    }
    
    public function toggleLock(Request $request)
    {
        // Validate the incoming request to ensure 'locked' is a boolean
        $validated = $request->validate([
            'locked' => 'required|boolean', // Ensuring locked is either 1 (true) or 0 (false)
        ]);
    
        // Retrieve the 'locked' status from the request
        $lockedStatus = $validated['locked'] ? true : false; // Convert to boolean (true/false)
    
        // Update the lock status for payment methods with specific IDs
        $updated = PaymentMethodLock::whereIn('id', [1]) // Replace with the actual IDs
            ->update(['locked' => $lockedStatus]);
    
        // Check if the update was successful
        if ($updated) {
            return redirect()->back()->with('success', 'Lock status updated successfully!');
        } else {
            return redirect()->back()->with('error', 'Failed to update lock status.');
        }
    }
    

    public function getLockStatus()
{
    // Retrieve the current lock status for the specific method
    $lockStatus = PaymentMethodLock::where('id', 1)->first(); // Replace with the actual ID or logic

    // Return the lock status to the frontend
    return view('your-view', ['lockStatus' => $lockStatus]);
}
    
    
    
 
    // Get All Offical Tasks
    public function getAllOfficalTask() {
            $officalTask = OfficalTask::all();
            return view('officalTasks', compact('officalTask'));
        }
    

    // Get Offical Tasks Status
    public function getOfficalTaskStatus()
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





    // View ALL Data Offical Partners 
    // officalPartners
    public function officalPartners()
    {
        
        $offical = Offical_partnersModel::all();
        return view('officalPartners', compact('offical'));
    }

    // Create Page view 
    public function createViewOfficalPartners()
    {
        return view('create_offical_partner');
    }


    // Store Offical Partner

    public function storeOfficalPartner(Request $request)
    {
        $validated = $request->validate([
            'partner_name' => 'required|string|max:255',
            'partner_img' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        // Handle image upload
        if ($request->hasFile('partner_img')) {
            $image = $request->file('partner_img');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images/offical'), $imageName); // Save to public/images/offical
    
            // Add the image path to the validated data
            $validated['partner_img'] = 'images/offical/' . $imageName;
        }
    
        // Save data to the database
        Offical_partnersModel::create($validated);
    
        return redirect()->route('offical_partners')->with('success', 'Official Partner created successfully');
    }
    

    // Delete Offical Partner

 public function deleteOfficalPartner($id)
    {
        // Find the task by ID
        $task = Offical_partnersModel::findOrFail($id);
    
        // Delete the task
        $task->delete();
    
        // Redirect with success message
        return redirect()->route('offical_partners')->with('success', 'Offical Partner deleted successfully');
    }


  // View Update Offical Partner 
public function updateViewOfficalPartner($id)
{
    $offical = Offical_partnersModel::findOrFail($id);

    return view('update_offical_partner' , compact('offical'));
}

    // Update Offical Partner 

    public function updateOfficalPartner(Request $request, $id)
    {
        $validated = $request->validate([
            'partner_name' => 'required|string|max:255',
            'partner_img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        // Find the official partner by ID
        $partner = Offical_partnersModel::findOrFail($id);
    
        // Handle image upload
        if ($request->hasFile('partner_img')) {
            // Delete the old image if it exists
            if ($partner->partner_img && file_exists(public_path($partner->partner_img))) {
                unlink(public_path($partner->partner_img));
            }
    
            $image = $request->file('partner_img');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images/offical'), $imageName); // Save to public/images/offical
    
            // Update the image path
            $validated['partner_img'] = 'images/offical/' . $imageName;
        }
    
        // Update partner details
        $partner->update($validated);
    
        return redirect()->route('offical_partners')->with('success', 'Official Partner updated successfully');
    }
    



    public function storeOfficalTasks(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'link' => 'required|string',
            'code' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images/officalTasks'), $imageName); // Save to public/images/offical
    
            // Add the image path to the validated data
            $validated['image'] = 'images/officalTasks/' . $imageName;
        }

        $task = OfficalTask::create($validated);

        return redirect()->route('offical_tasks')->with('success', 'Official task created successfully');

       

    }


  



// Delete Offical Tasks 

public function deleteOfficalTasks($id)
{
    $mission = OfficalTask::findOrFail($id);
    if ($mission) {
        $mission->delete();
        return redirect()->route('offical_tasks')->with('success', 'Task deleted successfully.');
    }

    return redirect()->route('offical_tasks')->with('error', 'Task not found.');
}

public function viewCreateOfficalTasks()
{
    return view('create_mission');
}



public function viewOfficalTasks($id)
{
    $mission = OfficalTask::findOrFail($id);

    return view('update_mission' , compact('mission'));
}

// Update OfficalTasks 


public function updateOfficalTasks(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'link' => 'required|string',
            'code' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
        ]);

        $offical = OfficalTask::findOrFail($id);


    if (!$offical) {
        return redirect()->route('offical_tasks')->with('error', 'Task not found.');
    }

      if ($request->hasFile('image')) {
        // Delete the old image if it exists
        if ($offical->image && file_exists(public_path($offical->image))) {
            unlink(public_path($offical->image));
        }

        // Upload the new image
        $image = $request->file('image');
        $imageName = time() . '_' . $image->getClientOriginalName();
        $image->move(public_path('images/officalTasks'), $imageName);

        // Update the image path in validated data
        $validated['image'] = 'images/officalTasks/' . $imageName;
    }
        

        $offical->update($validated);

        return redirect()->route('offical_tasks')->with('success', ' Offical Tasks updated successfully');
    }


    // View Daily Tasks

    public function dailyTasks()
    {
        $dailyTasks = DailyTask::all();
        return view('daily_tasks', compact('dailyTasks'));
    }


    // View Tasks
    public function tasks()
    {
        $tasks = Task::all();
        return view('tasks', compact('tasks'));
    }

     // Create Page Tasks
    public function createTask()
    {
        return view('create_task');
    }

    // Create Tasks
    public function storeTask(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'action_name' => 'required|string|max:255',
            'description' => 'required|string',
            'link' => 'required|string',
            'reward_coins' => 'required|integer|min:1',
        ]);

        Task::create($validated);

        return redirect()->route('tasks')->with('success', 'Task created successfully');
    }


    // Delete DAILY TASKS

    public function deleteTask($id)
    {
        // Find the task by ID
        $task = Task::findOrFail($id);
    
        // Delete the task
        $task->delete();
    
        // Redirect with success message
        return redirect()->route('tasks')->with('success', 'Task deleted successfully');
    }




    // Update View Tasks :

    public function updateViewTask($id)
    {
        $task = Task::findOrFail($id);
    
        return view('update_task' , compact('task'));
    }



    // Update Tasks 
    public function updateTask(Request $request, $id)
    {
        // Validate the incoming request
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'action_name' => 'required|string|max:255',
            'description' => 'required|string',
            'link' => 'required|string',
            'reward_coins' => 'required|integer|min:1',
        ]);
    
        // Find the task by ID
        $task = Task::findOrFail($id);
    
        // Update the task with validated data
        $task->update($validated);
    
        // Redirect with success message
        return redirect()->route('tasks')->with('success', 'Task updated successfully');
    }
    

   // Create Daily Tasks
    public function createDailyTask()
    {
        return view('create_daily_task');
    }


    // STORE DAILY TASKS
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



    // DELETE DAILY TASKS
    public function deleteDailyTasks($id)
{
    $dailyTask = DailyTask::findOrFail($id);

    // Perform deletion
    $dailyTask->delete();

    return redirect()->route('daily_tasks')->with('success', 'Daily task deleted successfully');
}



// UPDATE VIEW DAILY TASKS 

public function viewUpdateDailyTask($id)
{
    $dailyTask = DailyTask::findOrFail($id);

    return view('update_daily_task' , compact('dailyTask'));
}





public function updateDailyTask(Request $request, $id)
{
    // Find the existing daily task
    $dailyTask = DailyTask::findOrFail($id);

    // Validate the updated data
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'required|string',
        'required_login_streak' => 'required|integer|min:1|max:10',
        'reward_coins' => 'required|integer|min:1',
    ]);

    // Update the daily task with the validated data
    $dailyTask->update($validated);

    return redirect()->route('daily_tasks')->with('success', 'Daily task updated successfully');
}

    public function editTask(Task $task)
    {
        return view('tasks.edit', compact('task'));
    }


   

    public function editDailyTask(DailyTask $dailyTask)
    {
        return view('daily_tasks.edit', compact('dailyTask'));
    }

   

    public function deleteDailyTask(DailyTask $dailyTask)
    {
        $dailyTask->delete();
        return redirect()->route('daily_tasks')->with('success', 'Daily task deleted successfully');
    }
}
