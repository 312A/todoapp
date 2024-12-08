<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Tasks;

use Illuminate\Http\Request;


class TaskManager extends Controller
{

    public function listTask()
    {

        // $tasks = Tasks::where("user_id", Auth::id())
        //               ->where("status", NULL)
        //               ->paginate(3);
        // return view("welcome", compact('tasks'));


        $tasks = Tasks::where("user_id",Auth::id())
                    ->paginate(3);
                    return view("welcome",compact('tasks'));
        // $tasks = [
        //     'completed' => Tasks::where("user_id",Auth::id())
        //         ->where('status','accepted')
        //         ->paginate(3,["*"],'completed_page')
        // ];
    }

    public function addTask()
    {
        return view('tasks.add');
    }

    public function addTaskPost(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'deadline' => 'required',
        ]);

        $task = new Tasks();
        $task->title = $request->title;
        $task->description = $request->description;
        $task->deadline = $request->deadline;
        $task->user_id = Auth::id();

        if ($task->save()) {
            return redirect(route("home"))
                   ->with("success", "Task added successfully");
        }

        return redirect(route("task.add"))
               ->with("error", "Task not added");
    }

    public function updateTaskStatus($id)
    {
        $task = Tasks::find($id);

        if(!$task){
            return redirect()->back()-with('error','Task not found');

        }
        $task->status = $task->status == 1 ? 0 : 1;
        $task->save();
        return redirect()->back()->with('success','Task status updated Successfully');

        // if (Tasks::where("user_id", Auth::id())
        //     ->where('id', $id)->update(['status' => "completed"])) {
        //     return redirect(route("home"))->with("success", "Task Completed");
        // }
        // return redirect(route("home"))->with("error", "Error occurred while updating, try again");
    }
    public function updateTask(Request $request, $id)
    {
        $task = Tasks::find($id);

        if(!$task){
            return redirect()->route('home')->with('error','Task not found.');
        }
        $request->validate([
            'title' => 'required|string',
            'description'=> 'required|string',
            'status'=> 'required|boolean',
        ]);
        $task->title = $request->title;
        $task->description = $request->description;
        $task->status = $request->status;
        $task->save();
        return redirect()->route('home')->with('success','Task Upadted Successfully');
    }
    public function editTask($id){
        $task = Tasks::find($id);
        if(!$task){
            return redirect()->route('home')->with('error',"Task not found");
        }
        return view('tasks.edit',compact('task'));
    }
    public function deleteTask($id)
    {
        if (Tasks::where("user_id", Auth::id())
            ->where('id', $id)->delete()) {
            return redirect(route("home"))->with("success", "Task deleted successfully");
        }
        return redirect(route("home"))->with("error", "Error occurred in deleting, try again");
    }
}
