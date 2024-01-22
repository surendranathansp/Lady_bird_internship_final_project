<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class MenuSeeder extends Seeder
{
    public function run()
   
        {
            // Sample image URL
            $imageUrl = 'https://fhafnb.com/wp-content/uploads/2023/12/Tom-Yam-Thailand.jpg';
    
            // Seed the menus table
            DB::table('menus')->insert([
                'name' => 'Tom Yam',
                'description' => 'Lets talk about the bold and spicy vibe of Tom Yam, renowned as one of the best Asian foods with origins in Thailand.',
                'image_url' => $imageUrl,
                'price' => 10.99,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
    
            // Add more records as needed
        }
}
