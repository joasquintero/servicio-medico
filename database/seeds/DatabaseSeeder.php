<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        
        // La creación de datos de roles y permisos deben ejecutarse primero
        $this->call(RoleTableSeeder::class);
        $this->call(PermissionTableSeeder::class);
        // Los usuarios necesitarán los roles previamente generados
        $this->call(UserTableSeeder::class);
    }
}
