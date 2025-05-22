<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\WeightLog;
use Illuminate\Database\Eloquent\Factories\Factory;

class WeightLogFactory extends Factory
{
    protected $model = WeightLog::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
                'user_id' => User::factory(),
                'date' => $this->faker->dateTimeBetween('-30 days', 'now')->format('Y-m-d'),
                'weight' => $this->faker->randomFloat(1, 40, 120),
                'calories' => $this->faker->optional()->numberBetween(1000, 3500),
                'exercise_time' => $this->faker->optional()->time('H:i:s'),
                'exercise_content' => $this->faker->optional()->sentence(),
            ];
    }
}
