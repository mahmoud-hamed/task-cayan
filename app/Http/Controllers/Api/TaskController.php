<?php

namespace App\Http\Controllers\API;

use App\Models\Task;
use App\helpers\helper;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\TaskResource;
use App\Http\Requests\StoreTaskRequest;

class TaskController extends Controller
{
    public $helper;
    public function __construct()
    {
        $this->helper = new helper();

    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if (auth()->user()->roles_name == 'Manager') {
            $tasks = Task::all();
        } else {
            $tasks = Task::where('user_id', auth()->user()->id)->get();
        }

        return $this->ResponseJson('success', 'Tasks retrieved successfully', TaskResource::collection($tasks));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskRequest $request)
    {
        $data = $request->validated();
        $task = new Task($data);
        $task->save();

        return $this->ResponseJson('success', 'Task created successfully', new TaskResource($task));
    }

    /**
     * Update the task's status.
     */
    public function updateStatus(Request $request)
    {
        $request->validate([
            'status' => 'required',
            'id' => 'required|string|exists:tasks,id',
        ]);

        $task = Task::findOrFail($request->id);

        $newStatus = $request->input('status');

        $task->status = $newStatus;
        $task->save();

        return $this->ResponseJson('success', 'Status updated successfully');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'id' => 'required|string|exists:tasks,id',
        ]);

        $task = Task::findOrFail($request->id);

        $task->name = $request->input('name');
        $task->description = $request->input('description');

        if ($request->has('user_id')) {
            $task->user_id = $request->input('user_id');
        }

        $task->save();

        return $this->ResponseJson('success', 'Task updated successfully', new TaskResource($task));
    }

    
}
