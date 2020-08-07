<?php

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\Permission;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $admin_perm = Permission::where('slug','all-users')->first();
        $operator_perm = Permission::where('slug','update-tasks')->first();
        $doctor_perm = Permission::where('slug','create-tasks')->first();
        $patient_perm = Permission::where('slug','view-tasks')->first();

        $admin_role = new Role();
        $admin_role->slug = 'admin';
        $admin_role->name = 'Administrador';
        $admin_role->save();
        $admin_role->permissions()->attach($admin_perm);

        $operator_role = new Role();
        $operator_role->slug = 'operator';
        $operator_role->name = 'Operador';
        $operator_role->save();
        $operator_role->permissions()->attach($operator_perm);

        $doctor_role = new Role();
        $doctor_role->slug = 'doctor';
        $doctor_role->name = 'Doctor';
        $doctor_role->save();
        $doctor_role->permissions()->attach($doctor_perm);

        $patient_role = new Role();
        $patient_role->slug = 'patient';
        $patient_role->name = 'Paciente';
        $patient_role->save();
        $patient_role->permissions()->attach($patient_perm);

        $pending_role = new Role();
        $pending_role->slug = 'pending';
        $pending_role->name = 'Pendiente';
        $pending_role->save();
    }
}
