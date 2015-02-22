<?php

class UserTableSeeder extends DatabaseSeeder {
    public function run() {
        $users = array(
            array(
            'email' => 'admin@admin.local',
            'password' => Hash::make('a111111'),
            'username' => 'admin',
            'isAdmin' => 1,
            'isActive' => 1
        ));
        foreach ($users as $user):
            User::create($user);
        endforeach;
    }
}