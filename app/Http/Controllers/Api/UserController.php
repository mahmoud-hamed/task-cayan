<?php

namespace App\Http\Controllers\Api;

use App\helpers\helper;
use App\Models\Department;
use App\helpers\Attachment;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UserUpdateRequest;

class UserController extends Controller
{
    protected $userRepository;
    public $helper;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
        $this->helper = new helper();

    }

    // Your other methods

    public function index()
    {
        $data = $this->userRepository->all();
        return $this->ResponseJson('success', 'Data retrieved successfully', $data);
    }

    public function store(CreateUserRequest $request)
    {
        $data = $request->validated();
        $data['password'] = Hash::make($data['password']);

        // Set the fixed value "employee" for roles_name
        $data['roles_name'] = 'employee';

        $user = $this->userRepository->create($data);
        $user->assignRole($data['roles_name']);

        $departmentId = $request->input('department_id');

        if ($departmentId) {
            $user->employeeDepartments()->create(['department_id' => $departmentId]);
        }

        if ($request->hasFile('image')) {
            Attachment::addAttachment($request->file('image'), $user, 'employees/images', ['save' => 'original', 'usage' => 'employeeimage']);
        }

        return $this->ResponseJson('success', 'User added successfully');
    }

    public function edit($id)
    {
        $user = $this->userRepository->find($id);
        $departments = Department::all(); 

        return $this->ResponseJson('success', 'Data retrieved successfully', ['user' => $user, 'departments' => $departments]);
    }

    public function update(UserUpdateRequest $request, $id)
    {
        $user = $this->userRepository->find($id);

        $data = $request->validated();

        if ($request->has('password')) {
            $data['password'] = Hash::make($request->input('password'));
        } else {
            unset($data['password']);
        }

        $this->userRepository->update($id, $data);

        if ($request->has('department_id')) {
            $user->employeeDepartments()->updateOrCreate([], ['department_id' => $request->input('department_id')]);
        }

        if ($request->hasFile('image')) {
            $oldFile = $user->attachmentRelation[0] ?? null;
            Attachment::updateAttachment($request->file('image'), $oldFile, $user, 'employees/images', ['save' => 'original', 'usage' => 'employeeimage']);
        }

        return $this->ResponseJson('success', 'User information updated successfully');
    }

    public function destroy(Request $request)
    {
        $this->userRepository->delete($request->user_id);
        return $this->ResponseJson('success', 'User deleted successfully');
    }

}
