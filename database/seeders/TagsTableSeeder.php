<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tag = collect(['HTML', 'CSS', 'JavaScript', 'PHP', 'Laravel', 'Bootstrap', 'Photoshop', 'Figma', 'Anime']);
        $tag->each(function($c) {
            Tag::create([
                "name" => $c,
                "slug" => Str::slug($c),
            ]);
        });
    }
}
