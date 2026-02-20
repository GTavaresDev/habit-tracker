<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Habit>
 */
class HabitFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $habits = [
            'Ler 10 pag', 
            'Correr 3km',
            'Beber 3L de agua',
            'Ir a academia'
        ];
        
        return [
            'user_id' => 1,
            'name' => $this->
                        faker->
                        unique()->
                        randomElement($habits),
        ];
    }
}
