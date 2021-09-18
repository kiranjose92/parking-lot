<?php

use App\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'name' => Category::GENERAL
        ]);
        Category::create([
            'name' => Category::RESERVED
        ]);
    }
}
