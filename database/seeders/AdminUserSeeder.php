<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\UserProfiles;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Str;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create(
        	[
        		'name'=>'Admin User', 
        		'email'=>'admin@admin.com', 
        		'email_verified_at'=> now(),    
        		'password'=> bcrypt('NDRkUriyWT4dwK7'),
                'api_token' => Str::random(60),
        	]
        );

        $user->assignRole('admin');

        UserProfiles::create([
            'user_id' => $user->id
        ]);
    }
}
