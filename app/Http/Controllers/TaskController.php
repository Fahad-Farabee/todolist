<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    function add_task(Request $request)
    {
        $task = new Task();
        $task->task_details = $request->task_details;
        $task->dueDateTime = $request->dueDateTime;

        if ($task->save()) {
            return ["result" => "Task Added Successfully"];
        } else {
            return ["result" => "operation Failed"];
        }
    }

    function show_task() {}

    function delete_task($id) {}

    function update_task_status($id) {}
}
