<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $departmetns = Department::latest()->get();
        return view('departments.index',compact('departmetns'));
    }

    public function getdepartments()
    {
        $departments = Department::latest()->get(); // Fetch the latest package data
        return view('departments.table', ['departments' => $departments])->render();
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
        ],
     
    );

        // // Create a new instance of the model
        $model = new Department();

        // Assign the form data to the model attributes
        $model->name = $request->name;

        // Save the model to the database
        $model->save();

        return response()->json([
            'status' => 'success'
        ]);
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $request->validate([
            'up_name' => 'required|string',
        ],
        [
            'up_name.required' => 'required',
        ]);

        Department::where('id',$request->up_id)->update([
            'name' => $request->up_name,
        ]);
         return response()->json([
            'status' => 'success'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $department = Department::find($id);
    
        if ($department) {
            // Check if the department has associated users
            if ($department->employee_departments->isEmpty()) {
                // No associated users, safe to delete the department
                $department->delete();
    
                return redirect('/departmetns')->with(
                    'delete',
                    'Department deleted Successfully'
                );
            } else {
                return redirect('/departmetns')->with(
                    'error',
                    'Cannot delete the department because it has associated users.'
                );
            }
        } else {
            return redirect('/departmetns')->with(
                'error',
                'Department not found.'
            );
        }
    }

    public function search(Request $request)
    {
        $departmentId = $request->input('department');
        $minSalary = $request->input('salary');
    
        $query = User::query();
    
        if ($departmentId) {
            $query->whereHas('departments', function ($q) use ($departmentId) {
                $q->where('department_id', $departmentId);
            });
        }
    
        if ($minSalary) {
            $query->where('salary', '>=', $minSalary);
        }
    
        $users = $query->get();
    
        // Calculate count and sum for each department
        $departments = Department::withCount(['users as employee_count', 'users as total_salary' => function ($query) {
            $query->select(DB::raw('sum(salary)'));
        }])->get();
    
        return view('departments.search', compact('users', 'departments'));
    }
    
    

    
}