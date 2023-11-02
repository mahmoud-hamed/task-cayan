<?php
namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Department;
use App\helpers\Attachment;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UserUpdateRequest;

class UserController extends Controller
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;

        $this->middleware('permission:قائمة المستخدمين', ['only' => ['index']]);
        $this->middleware('permission:اضافة صلاحية', ['only' => ['create', 'store']]);
        $this->middleware('permission:تعديل صلاحية', ['only' => ['edit', 'update']]);
        $this->middleware('permission:حذف صلاحية', ['only' => ['destroy']]);
    }

    // Your other methods

    public function index()
    {
        $data = $this->userRepository->all();
        return view('users.show_users', compact('data'));
    }

    public function create()
    {
        $departments = Department::all(); // Fetch all departments

        return view('users.Add_user' ,  compact('departments'));
    }

    public function store(CreateUserRequest $request)
    {
        $data = $request->validated();
        $data['password'] = Hash::make($data['password']);
        $user = $this->userRepository->create($data);
        $user->assignRole($request->input('roles_name'));

        $departmentId = $request->input('department_id');

        if ($departmentId) {
            $user->employeeDepartments()->create(['department_id' => $departmentId]);
        }

        if ($request->hasFile('image')) {
         
            Attachment::addAttachment($request->file('image'), $user, 'employees/images',  ['save' => 'original', 'usage' => 'employeeimage']);
        }
    
        return redirect()->route('users.index')->with('success', 'User added successfully');
    }
    

    public function edit($id)
    {
        $user = $this->userRepository->find($id);
        $departments = Department::all(); // Fetch all departments

        return view('users.edit', compact('user' , 'departments'));
    }

    public function update(UserUpdateRequest $request, $id)
    {
        $user = $this->userRepository->find($id);
        
        $data = $request->validated();
    
        // Check if a new password was provided
        if ($request->has('password')) {
            $data['password'] = Hash::make($request->input('password'));
        } else {
            // If not, remove the 'password' from the data array
            unset($data['password']);
        }
    
        $this->userRepository->update($id, $data);
    
        // Update the user's associated department if 'department_id' is provided
        if ($request->has('department_id')) {
            $user->employeeDepartments()->updateOrCreate([], ['department_id' => $request->input('department_id')]);
        }
    
        if ($request->hasFile('image')) {
            $oldFile = $user->attachmentRelation[0] ?? null;
            Attachment::updateAttachment($request->file('image'), $oldFile, $user, 'employees/images', ['save' => 'original', 'usage' => 'employeeimage']);
        }
    
        return redirect()->route('users.index')->with('success', 'User information updated successfully');
    }
    

    public function destroy(Request $request)
    {
        $this->userRepository->delete($request->user_id);
        return redirect()->route('users.index')->with('success', 'User deleted successfully');
    }

    
}
