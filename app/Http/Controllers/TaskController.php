<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
{
    //adding task
    function add_task(Request $request)
    {
        $rules = array(
            'task_details' => 'required',
            'date' => 'required',
            'time' => 'required',
        );
        $validation = Validator::make($request->all(), $rules);
        if ($validation->fails()) {
            return response()->json([
                'success' => false,
                'msg' => $validation->errors()->first()
            ], 400);
        } else {
            $task = new Task();
            $task->task_details = $request->task_details;
            /* $task->task_status = $request->task_status; */
            $date = $request->date;
            $time = $request->time;
            $combinedDateTime = date("Y-m-d H:i:s", strtotime("$date $time"));
            $task->due_date_time = $combinedDateTime;
            if ($task->save()) {
                /* return ['result' => "Task Added Successfully"]; */
                return response()->json([
                    'success' => true,
                    'msg' => "Task added successfully!",
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'msg' => "Operation Failed!!",
                ], 400);
            }
        }
    }

    //showing tasks
    function show_tasks()
    {
        $tasks = Task::all();
        return response()->json($tasks);
    }

    //updating the task's status.
    function update_task($id)
    {
        $task = Task::findOrFail($id);
        if ($task->task_status == true) {
            return response()->json([
                'success' => false,
                'msg' => "Task already completed!",
                'status' => $task->task_status,
            ], 200);
        } else {
            $task->task_status = !$task->task_status;
            if ($task->save()) {
                return response()->json([
                    'success' => false,
                    'msg' => "Task status updated successfully!",
                    'status' => $task->task_status,
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'msg' => "Failed to update!",
                    'status' => $task->task_status,
                ], 500);
            }
        }
    }

    //delete Task
    function delete_task($id)
    {
        $deleted_task = Task::destroy($id);
        if ($deleted_task) {
            return response()->json([
                'success' => true,
                'msg' => "Task deleted successfully!",
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'msg' => "Task not found or could not be deleted!"
            ], 404);
        }
    }
}
