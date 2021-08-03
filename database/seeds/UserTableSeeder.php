<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user1 = new \App\User();
        $user1->name = 'Eslam';
        $user1->email = 'eslam011@gmail.com';
        $user1->password =bcrypt('123123');
        $user1->isactive = 1;
        $user1->save();
        $user1->attachRole('super_admin');

//        $user2 = new \App\User();
//        $user2->name = 'Ali';
//        $user2->email = 'Ali@gmail.com';
//        $user2->password =bcrypt('123456');
//        $user2->isactive = 1;
//        $user2->save();

    }
}
