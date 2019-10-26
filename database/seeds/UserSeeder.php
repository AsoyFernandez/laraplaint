<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;
use App\Kategori;
use App\Lokasi;
use App\Mesin;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $lokasi = new Lokasi();
        $lokasi->nama = 'SG Kranji';
        $lokasi->save(); 

        $lokasi1 = new Lokasi();
        $lokasi1->nama = 'SG Narma';
        $lokasi1->save();

        $lokasi2 = new Lokasi();
        $lokasi2->nama = 'SG Ciracas';
        $lokasi2->save();  
        
        $role = new role();
        $role->nama = 'Super User';
        $role->save();

        $kategori = new Kategori();
        $kategori->nama = 'Redemption';
        $kategori->save();

        $kategori1 = new Kategori();
        $kategori1->nama = 'Dedicated';
        $kategori1->save();

        $kategori2 = new Kategori();
        $kategori2->nama = 'Kudy Ride';
        $kategori2->save();

        $kategori3 = new Kategori();
        $kategori3->nama = 'Simulator';
        $kategori3->save();

        $role1 = new Role();
        $role1->nama = 'Outlet Leader';
        $role1->save();

        $role2 = new Role();
        $role2->nama = 'Teknisi';
        $role2->save();

        $role3 = new Role();
        $role3->nama = 'Supervisor Area';
        $role3->save();

        $mesin = new Mesin();
        $mesin->nama = 'Dirty Drivin';
        $mesin->kategori_id = $kategori3->id;
        $mesin->save();

        $mesin1 = new Mesin();
        $mesin1->nama = 'Sega Really';
        $mesin1->kategori_id = $kategori1->id;
        $mesin1->save();

        $mesin2 = new Mesin();
        $mesin2->nama = 'Maxtune';
        $mesin2->kategori_id = $kategori1->id;
        $mesin2->save();

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

        $user2 = new User();
        $user2->name = 'Natsu';
        $user2->email = 'natsu@gmail.com';
        $user2->nik = '999999888888';
        $user2->role_id = $role2->id;
        $user2->password = bcrypt('02091997');
        $user2->save();

        $user3 = new User();
        $user3->name = 'Gray';
        $user3->email = 'gray@gmail.com';
        $user3->nik = '999999888877';
        $user3->role_id = $role3->id;
        $user3->password = bcrypt('02091997');
        $user3->save();



    }
}
