<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);

        Eloquent::unguard();
        $this->call(UsersTablesSeeder::class);
        $this->call(RolesTablesSeeder::class);
        $this->call(EmployeesTableSeeder::class);
        $this->call(ContractsTableSeeder::class);
        $this->call(TypesTableSeeder::class);
        $this->call(VacationsTableSeeder::class);

    }
}
