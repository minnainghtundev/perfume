<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\Hash;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        //For User

        //For User
        \App\Models\User::factory()->create([
            'name'      => 'Y-perfume',
            'email'     => 'admin@gmail.com',
            'password'  => Hash::make('admin12345'),
        ]);

        
     

        //For Category

        \App\Models\Category::factory()->create([
            'name' => 'Dior Sauvage',
            'photo' => 'Dior Sauvage.jpg',
            'gender' => 'Men',
            'remark' => ''
        ]);

        \App\Models\Category::factory()->create([
            'name' => 'Chanel Coco Mademoiselle de Eau de Perfum',
            'photo' => 'Chanel Coco Mademoiselle de Eau de Perfum.jpg',
            'gender' => 'Women',
            'remark' => ''
        ]);

        \App\Models\Category::factory()->create([
            'name' => 'Chanel Coco Mademoiselle de Eau de Perfum',
            'photo' => 'Chanel Coco Mademoiselle de Eau de Perfum.jpg',
            'gender' => 'Women',
            'remark' => ''
        ]);
    }

    
}
