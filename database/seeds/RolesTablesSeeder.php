<?php

use Illuminate\Database\Seeder;
use App\Role;
class RolesTablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        Role::create(['name' => 'SuperAdmin']);
        Role::create(['name' => 'Admin']);

    }
}
