<?php

use Illuminate\Database\Seeder;
use App\User\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            ['name' => 'root'],
            ['name' => 'author'],
            ['name' => 'standard_user']
        ];

        foreach ($roles as $role) {
            Role::create($role);
        }
    }
}
