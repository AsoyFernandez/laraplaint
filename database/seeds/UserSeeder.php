<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = new role();
        $role->nama = 'Admin';
        $role->save();

        $role1 = new role();
        $role1->nama = 'Member';
        $role1->save();

        $user = new User();
        $user->name = 'Admin Laraplaint';
        $user->email = 'admin@laraplaint.com';
        $user->nik = '999999999999';
        $user->role_id = $role->id;
        $user->password = bcrypt('rahasia');
        $user->save();


        $user1 = new User();
        $user1->name = 'Esa Rizki Hari Utama';
        $user1->email = 'utama@raharja.info';
        $user1->nik = '970902190725';
        $user1->role_id = $role1->id;
        $user1->password = bcrypt('02091997');
        $user1->save();



    }
}
