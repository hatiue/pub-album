<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;
use App\Models\Bind;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Bind>
 */
class BindFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    private static int $posNumber = 1;

    public function definition(): array
    {
        if(!Storage::exists('public/images')) {
            Storage::makeDirectory('public/images');
        }
        
        $lastUserId = Bind::max('user_id');
        $userId  = $lastUserId + 1;

        return [
            'imgurl' => $this->faker->image(storage_path('app/public/images'), 640, 480, null, false),
            'composition' => $this->faker->realText(128),
            'position' => self::$posNumber++,
            'user_id' => $userId
        ];
    }
}