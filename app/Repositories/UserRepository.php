<?php
namespace App\Repositories;

use App\Models\User;
use App\Models\Employee;


class UserRepository 
{
    public function all()
    {
        return User::orderBy('id', 'DESC')
            ->whereNotIn('id', [auth()->user()->id])
            ->where('roles_name', '!=', 'SuperAdmin')
            ->paginate(5);
    }

    public function create($data)
    {
        return User::create($data);
    }

    public function find($id)
    {
        return User::find($id);
    }

    public function update($id, $data)
    {
        $user = User::find($id);
        $user->update($data);
        return $user;
    }

    public function delete($id)
    {
        return User::find($id)->delete();
    }

 
}
