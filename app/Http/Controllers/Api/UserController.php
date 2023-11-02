<?php

namespace App\Http\Controllers\Api;

use App\Models\Department;
use App\helpers\Attachment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UserUpdateRequest;

class UserController extends Controller
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;

    }

    // Your other methods

    public function index()
    {
        $data = $this->userRepository->all();
        return response()->json(['data' => $data]);
    }


    public function store(CreateUserRequest $request)
    {
        $data = $request->validated();
        $data['password'] = Hash::make($data['password']);
        
        // Set the fixed value "employee" for roles_name
        $data['roles_name'] = 'employee';
        
        $user = $this->userRepository->create($data);
        
        $departmentId = $request->input('department_id');
        $user->assignRole( $data['roles_name']);

        if ($departmentId) {
            $user->employeeDepartments()->create(['department_id' => $departmentId]);
        }
    
        if ($request->hasFile('image')) {
            Attachment::addAttachment($request->file('image'), $user, 'employees/images', ['save' => 'original', 'usage' => 'employeeimage']);
        }
    
        return response()->json(['message' => 'User added successfully']);
    }
    
    public function edit($id)
    {
        $user = $this->userRepository->find($id);
        $departments = Department::all(); // Fetch all departments

        return response()->json(['user' => $user, 'departments' => $departments]);
    }

    public function update(UserUpdateRequest $request)
    {
        $user = $this->userRepository->find($request->id);

        $data = $request->validated();

        // Check if a new password was provided
        if ($request->has('password')) {
            $data['password'] = Hash::make($request->input('password'));
        } else {
            // If not, remove the 'password' from the data array
            unset($data['password']);
        }

        $this->userRepository->update($request->id, $data);

        // Update the user's associated department if 'department_id' is provided
        if ($request->has('department_id')) {
            $user->employeeDepartments()->updateOrCreate([], ['department_id' => $request->input('department_id')]);
        }

        if ($request->hasFile('image')) {
            $oldFile = $user->attachmentRelation[0] ?? null;
            Attachment::updateAttachment($request->file('image'), $oldFile, $user, 'employees/images', ['save' => 'original', 'usage' => 'employeeimage']);
        }

        return response()->json(['message' => 'User information updated successfully']);
    }

    public function destroy(Request $request)
    {
        $this->userRepository->delete($request->user_id);
        return response()->json(['message' => 'User deleted successfully']);
    }
}
