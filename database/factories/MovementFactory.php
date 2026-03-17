<?php

namespace Database\Factories;

use App\Models\Equipement;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Movement>
 */
class MovementFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'equipement_id' => Equipement::pluck('id')->random(),
            'type' => $this->faker->randomElement(['entree', 'sortie']),
            'quantite' => $this->faker->numberBetween(1, 5),
            'direction_concernee' => $this->faker->randomElement(['RH', 'DFC', 'Capitainerie', 'DDN', 'DG', 'TC', 'DMA', 'Juridique', 'PFSO']),
            'motif_ou_reference' => 'Test automatique ' . $this->faker->word(),
            'date_mouvement' => now()->subDays(rand(0, 10)),
            'user_id' => 1,
        ];
    }
}
