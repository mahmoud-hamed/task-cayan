<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Resources\TaskResource;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Check if the authenticated user is a Manager
        if (auth()->user()->roles_name == 'Manager') {
            // Authenticated user is a Manager, fetch all tasks
            $tasks = Task::all();
        } else {
            // Authenticated user is an Employee, fetch their own tasks
            $tasks = Task::where('user_id', auth()->user()->id)->get();
        }

        // Use TaskResource to format the response
        return TaskResource::collection($tasks);
    }

    /**
     * Show the form for creating a new resource.
     */

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskRequest $request)
    {
        $data = $request->validated();
        $task = new Task($data);
        $task->save();

        // Use TaskResource to format the response
        return new TaskResource($task);
    }

    /**
     * Update the task's status.
     */
    public function updateStatus(Request $request)
    {
        $request->validate([
            'status' => 'required',
            'id' => 'required|string',
        ]);

        // Find the task by ID
        $task = Task::findOrFail($request->id);


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

    

    /**
     * Show the form for editing the specified resource.
     */

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        // Find the task by ID
        $task = Task::findOrFail($request->id);

        // Update the task's attributes
        $task->name = $request->input('name');
        $task->description = $request->input('description');

        // Only update user_id if it's provided in the request
        if ($request->has('user_id')) {
            $task->user_id = $request->input('user_id');
        }

        // Save the updated task
        $task->save();

        // Use TaskResource to format the response
        return new TaskResource($task);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Implement the deletion logic for tasks
    }
}
