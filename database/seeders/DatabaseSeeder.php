<?php

namespace Database\Seeders;

use App\Models\Device;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

         \App\Models\User::create([
             'name' => 'Admin User',
             'email' => 'admin@admin.com',
             'password' => Hash::make('admin'),
             'device_id' => 'E999456F-DF6A-47E1-B652-170426117CBB'
         ]);

         $this->call(StationsSeeder::class);
    }
}
