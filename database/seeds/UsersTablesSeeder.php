<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;


class UsersTablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Un seul admin par défaut
        User::create([
            'first_name' => 'amine',
            'last_name'=> 'zaddem',
            'email' => 'admin@test.com',
            'password' => Hash::make('test12345') ,
            'role_id' => 1 ,
            'remember_token'=> Str::random(10),
        ]);
    }
}
