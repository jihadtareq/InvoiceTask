<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::where('is_admin',1)->first();
        if(is_null($user)){
            User::create([
                'name'=>'admin',
                'email'=>'admin@admin.com',
                'password'=>Hash::make(123456),
                'is_admin'=>1,
            ]);
        }
    }
}
