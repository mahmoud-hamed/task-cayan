<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Department
 * 
 * @property int $id
 * @property string $name
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|EmployeeDepartment[] $employee_departments
 *
 * @package App\Models
 */
class Department extends Model
{
	protected $table = 'departments';

	protected $fillable = [
		'name'
	];

	public function employee_departments()
	{
		return $this->hasMany(EmployeeDepartment::class);
	}

	public function users()
    {
        return $this->belongsToMany(User::class, 'employee_departments', 'department_id', 'user_id');
    }

}
