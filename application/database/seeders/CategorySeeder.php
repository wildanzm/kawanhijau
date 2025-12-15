<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Sayuran Daun',      
            'Sayuran Buah',     
            'Buah-buahan',     
            'Umbi-umbian',      
            'Kacang-kacangan',   
            'Rempah & Bumbu',   
            'Beras & Bijian',   
            'Paket Sayur',      
        ];

        foreach ($categories as $category) {
            Category::firstOrCreate(
                ['slug' => Str::slug($category)],
                ['name' => $category]
            );
        }
    }
}
