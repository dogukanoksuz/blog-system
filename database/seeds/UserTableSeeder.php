<?php

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Doğukan Öksüz',
            'email' => 'me@dogukan.dev',
            'password' => '$2y$10$0C2HDoLz3CXCziWt46rlBOq0t4SInXaxYz.GRkWYi9xb4OjbzymgO',
        ]);

        DB::table('role_user')->insert(['role_id' => 1, 'user_id' => 1]);
        DB::table('role_user')->insert(['role_id' => 2, 'user_id' => 1]);
        DB::table('role_user')->insert(['role_id' => 3, 'user_id' => 1]);
    }
}
