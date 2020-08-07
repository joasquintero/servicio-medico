<?php

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $admin_role = Role::where('slug','admin')->first();
        $operator_role = Role::where('slug', 'operator')->first();
        $doctor_role = Role::where('slug', 'doctor')->first();
        $patient_role = Role::where('slug', 'patient')->first();

        $allUsers = new Permission();
        $allUsers->slug = 'all-users';
        $allUsers->name = 'Create Tasks';
        $allUsers->save();
        $allUsers->roles()->attach($admin_role);

        $updateTasks = new Permission();
        $updateTasks->slug = 'update-tasks';
        $updateTasks->name = 'Edit Users';
        $updateTasks->save();
        $updateTasks->roles()->attach($operator_role);

        $createTasks = new Permission();
        $createTasks->slug = 'create-tasks';
        $createTasks->name = 'Edit Users';
        $createTasks->save();
        $createTasks->roles()->attach($doctor_role);

        $viewTasks = new Permission();
        $viewTasks->slug = 'view-tasks';
        $viewTasks->name = 'Edit Users';
        $viewTasks->save();
        $viewTasks->roles()->attach($patient_role);
    }
}
