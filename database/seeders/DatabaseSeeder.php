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
            'name' => 'admin',
            'created_at' => new \DateTime(),
            'updated_at' => new \DateTime()
        ]);

        DB::table('roles')->insert([
            'name' => 'supervisor',
            'created_at' => new \DateTime(),
            'updated_at' => new \DateTime()
        ]);

        DB::table('roles')->insert([
            'name' => 'user',
            'created_at' => new \DateTime(),
            'updated_at' => new \DateTime()
        ]);

        DB::table('skills')->insert([
            'name' => 'html and css',
            'created_at' => new \DateTime(),
            'updated_at' => new \DateTime()
        ]);

        DB::table('skills')->insert([
            'name' => 'javascript',
            'created_at' => new \DateTime(),
            'updated_at' => new \DateTime()
        ]);

        DB::table('skills')->insert([
            'name' => 'php',
            'created_at' => new \DateTime(),
            'updated_at' => new \DateTime()
        ]);

        DB::table('skills')->insert([
            'name' => 'react',
            'created_at' => new \DateTime(),
            'updated_at' => new \DateTime()
        ]);
    }
}
