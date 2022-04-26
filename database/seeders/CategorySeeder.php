<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            ['name' => 'ASUS', 'slug' => 'asus'],
            ['name' => 'DELL', 'slug' => 'dell'],
            ['name' => 'HP', 'slug' => 'hp'],
            ['name' => 'Apple', 'slug' => 'apple']
        ];
        DB::table('categories')->delete();
        DB::table('categories')->insert($categories);
    }
}
