<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        for($i=1; $i<11 ; $i++){
            $user = \App\Models\User::create([
                'name' => 'test'.$i,
                'email' => 'test'.$i.'@gmail.com',
                'password' => Hash::make('test12345')
                ]);
        }
    }
}
