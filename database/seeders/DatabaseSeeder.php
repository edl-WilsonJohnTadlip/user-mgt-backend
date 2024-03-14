<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        DB::table('roles')->insert([
            'name' => 'Admin',
            'created_at' => new \DateTime(),
            'updated_at' => new \DateTime()
        ]);

        DB::table('roles')->insert([
            'name' => 'Supervisor',
            'created_at' => new \DateTime(),
            'updated_at' => new \DateTime()
        ]);

        DB::table('roles')->insert([
            'name' => 'User',
            'created_at' => new \DateTime(),
            'updated_at' => new \DateTime()
        ]);
    }
}
