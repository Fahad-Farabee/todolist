<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Task;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'task_details' => fake()->text(),
            'task_status' => fake()->randomElement([true, false]),
            'dueDateTime' => fake()->dateTime(),
            'created_at' => fake()->dateTime(),
        ];
    }
}
