<?php

use Illuminate\Database\Seeder;
use App\User;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->name = 'Admin Laraplaint';
        $user->email = 'admin@laraplaint.com';
        $user->password = bcrypt('02091997');
        $user->save();
    }
}
