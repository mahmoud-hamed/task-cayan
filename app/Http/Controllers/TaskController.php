<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\StoreTaskRequest;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Check if the authenticated user is a Manager
        if (auth()->user()->roles_name == 'Manager') {
            // Authenticated user is a Manager, fetch all tasks
            $data = Task::all();
        } else {
            // Authenticated user is an Employee, fetch their own tasks
            $data = Task::where('user_id', auth()->user()->id)->get();
        }
    
        return view('tasks.index', compact('data'));
    }
        /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::where('manager_id', auth()->user()->id)->get();
        return view('tasks.create' , compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskRequest $request)
    {
        $data = $request->validated();
        $task = new Task($data);
        $task->save();
    
        return redirect()->route('tasks.index')->with('success', 'Task created successfully');
    }

        public function updateStatus(Request $request, Task $task)
    {
        $newStatus = $request->input('status');

        // Update the task's status
        $task->status = $newStatus;
        $task->save();

        // Return a JSON response to acknowledge the update
        return response()->json(['message' => 'Status updated successfully']);
    }

    
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Retrieve the task by its ID for editing
        $task = Task::findOrFail($id);
        $users = User::where('manager_id', auth()->user()->id)->get();

        return view('tasks.edit', compact('task' , 'users'));
    }
    
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
        ]);
    
        // Find the task by ID
        $task = Task::findOrFail($id);
    
        // Update the task's attributes
        $task->name = $request->input('name');
        $task->description = $request->input('description');
    
        // Only update user_id if it's provided in the request
        if ($request->has('user_id')) {
            $task->user_id = $request->input('user_id');
        }
    
        // Save the updated task
        $task->save();
    
        // Redirect back with a success message
        return redirect()->route('tasks.index')->with('success', 'Task updated successfully');
    }
    
    /**
     * Remove the specified resource from storage.
     */
 
}
