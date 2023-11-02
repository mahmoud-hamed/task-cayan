<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class EmployeeDepartment
 * 
 * @property int $id
 * @property int|null $user_id
 * @property int|null $department_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Department|null $department
 * @property User|null $user
 *
 * @package App\Models
 */
class EmployeeDepartment extends Model
{
	protected $table = 'employee_departments';

	protected $casts = [
		'user_id' => 'int',
		'department_id' => 'int'
	];

	protected $fillable = [
		'user_id',
		'department_id'
	];

	public function department()
	{
		return $this->belongsTo(Department::class);
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
