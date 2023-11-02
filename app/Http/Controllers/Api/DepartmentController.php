<?php



namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\DepartmentResource;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $departments = Department::latest()->get();
        return DepartmentResource::collection($departments);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
        ]);

        $department = Department::create([
            'name' => $request->name,
        ]);

        return new DepartmentResource($department);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'id'=>'required|exists:departments,id'
        ]);

        $department = Department::findOrFail($request->id);

        $department->update([
            'name' => $request->name,
        ]);

        return new DepartmentResource($department);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $request->validate([
            'id'=>'required|exists:departments,id'
        ]);
        $department = Department::findOrFail($request->id);

        if ($department) {
            // Check if the department has associated users
            if ($department->employee_departments->isEmpty()) {
                // No associated users, safe to delete the department
                $department->delete();

                return response()->json([
                    'message' => 'Department deleted successfully',
                ]);
            } else {
                return response()->json([
                    'error' => 'Cannot delete the department because it has associated users.',
                ], 400);
            }
        } else {
            return response()->json([
                'error' => 'Department not found.',
            ], 404);
        }
    }
}
