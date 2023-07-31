<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = collect(['Code', 'Design', 'Blog']);
        $categories->each(function($c) {
            Category::create([
                "name" => $c,
                "slug" => Str::slug($c),
            ]);
        });
    }
}
