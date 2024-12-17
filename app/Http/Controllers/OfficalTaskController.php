<?php

namespace App\Http\Controllers;
use App\Models\OfficalTask;
use Illuminate\Http\Request;

class OfficalTaskController extends Controller
{

    public function index(Request $request)
    {

        $offical = OfficalTask::all();
        return view('officalTasks', compact('offical'));
    }

    //
   
}
