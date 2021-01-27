<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->insertAdmin();
    }

    public function insertAdmin(){
        DB::table('users')->insert([
            'username' => 'admin',
            'email' => 'admin@example.com',
            'password'=> '$2y$12$F7fSoO5ew7Ly4kQZLMX4Ze3mT0CGDyfnlqsOPdZR1id8XjcSbnanK',
            'user_role'=> User::SUPER_ADMIN_ROLE
        ]);
    }
}
