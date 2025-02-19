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
            'name' => 'Dior',
            'photo' => 'Dior.jpg',
            'remark' => '',
        ]);

        \App\Models\Category::factory()->create([
            'name' => 'Chanel',
            'photo' => 'Chanel.jpg',
            'remark' => ''
        ]);

        \App\Models\Category::factory()->create([
            'name' => 'MYST',
            'photo' => 'myst.jpg',
            'remark' => ''
        ]);



        \App\Models\Item::factory()->create([

            'category_id'=>'3',
            'name' => 'MYST',
            'photo' => '2.jpg',
            'price' => 50,
            'qty' => 5,
            'gender' => 'Men',
            'status' => '',
            'remark' => ''
        ]);

        \App\Models\Item::factory()->create([

            'category_id'=>'2',
            'name' => 'Chanel Coco Mademoiselle de Eau de Perfum ',
            'photo' => '1.jpg',
            'price' => 50,
            'qty' => 5,
            'gender' => 'Women',
            'status' => '',
            'remark' => ''
        ]);
    
   }

}
