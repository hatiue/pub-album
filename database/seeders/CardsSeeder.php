<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Str;
use App\Models\Bind;
use App\Models\Image;

class CardsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Bind::factory()->count(9)->create()->each(fn($card) =>
            Image::factory()->count(1)->create()
            // ->each(fn($image) => $card->image()->attach($image->id))
        );
    }
}
