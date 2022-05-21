<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'id' => '1',
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => '$2y$10$dPtEOKMvLI0Gzns93neWretHuxa0tXSw/mXKMy5o5SyhKIbWyafpe',
            'user_type' => '0',
        ]);
    }
}
