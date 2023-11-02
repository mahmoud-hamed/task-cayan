<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'قائمة المستخدمين',
            'إنشاء مستخدم',
            'حفظ المستخدم',
            'تعديل المستخدم',
            'تحديث المستخدم',
            'حذف المستخدم',
            'تعديل الملف الشخصي',
            'الصلاحيات',
            'اضافة صلاحية',
            'تعديل صلاحية',
            'حذف صلاحية',
            'قائمة الاقسام',
            'إنشاء قسم',
            'حفظ قسم',
            'تعديل قسم',
            'تحديث قسم',
            'حذف قسم',
            'قائمة المهام',
            'إنشاء مهمه',
            'حفظ مهمه',
            'تعديل مهمه',
            'تحديث مهمه',
            'حذف مهمه',
        ];

        foreach ($permissions as $permission) {

            Permission::create(['name' => $permission]);
        }
    }
}
