<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Models\Role;
use App\Models\Permission;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin_role = Role::where('slug','admin')->first();
        $operator_role = Role::where('slug', 'operator')->first();
        $doctor_role = Role::where('slug', 'doctor')->first();
        $patient_role = Role::where('slug', 'patient')->first();
        $pending_role = Role::where('slug', 'pending')->first();

        $admin_perm = Permission::where('slug','all-users')->first();
        $operator_perm = Permission::where('slug','update-tasks')->first();
        $doctor_perm = Permission::where('slug','create-tasks')->first();
        $patient_perm = Permission::where('slug','view-tasks')->first();

        $admin = new User();
        $admin->names = 'Joas';
        $admin->family_names = 'Quintero';
        $admin->id_number = '123456789';
        $admin->email = 'test@test.com';
        $admin->password = bcrypt('000000');
        $admin->available = true;
        $admin->save();
        $admin->roles()->attach($admin_role);
        $admin->permissions()->attach($admin_perm);
    
        for ($d=0; $d < 5; $d++) { 
            $doctor = new User();
            $doctor->names = 'Doctor' . $d;
            $doctor->family_names = 'Lastname' . $d;
            $doctor->id_number = '1123456' . $d;
            $doctor->email = 'doctor'. $d .'@example.com';
            $doctor->password = bcrypt('secret');
            $doctor->available = true;
            $doctor->save();
            $doctor->roles()->attach($doctor_role);
            $doctor->permissions()->attach($doctor_perm);
        }

        for ($pt=0; $pt < 5; $pt++) { 
            $patient = new User();
            $patient->names = 'Patient' . $pt;
            $patient->family_names = 'Lastname' . $pt;
            $patient->id_number = '1223456' . $pt;
            $patient->email = 'user' . $pt . '@example.com';
            $patient->password = bcrypt('secret');
            $patient->available = true;
            $patient->save();
            $patient->roles()->attach($patient_role);
            $patient->permissions()->attach($patient_perm);
        }

        for ($pd=0; $pd < 5; $pd++) { 
            $operator = new User();
            $operator->names = 'Operator' . $pd;
            $operator->family_names = 'Lastname' . $pd;
            $operator->id_number = '1233456' . $pd;
            $operator->email = "operator' . $pd . '@example.com";
            $operator->password = bcrypt('secret');
            $operator->available = true;
            $operator->save();
            $operator->roles()->attach($operator_role);
            $operator->permissions()->attach($operator_perm);
        }

        $operator = new User();
        $operator->names = 'Pending';
        $operator->family_names = 'Lastname';
        $operator->id_number = '12434567';
        $operator->email = "pendingr@example.com";
        $operator->password = bcrypt('secret');
        $operator->available = true;
        $operator->save();
        $operator->roles()->attach($pending_role);

    }
}
