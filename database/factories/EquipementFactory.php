<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Equipement>
 */
class EquipementFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $equipements = ['PC Portable Dell', 'Écran HP 24"', 'Imprimante LaserJet', 'Clavier USB', 'Souris Optique', 'Toner HP 85A', 'Switch Cisco 24p'];

        return [
            'designation' => $this->faker->randomElement($equipements),
            'categorie' => $this->faker->randomElement(['Informatique', 'Consommable', 'Réseau']),
            'quantite_en_stock' => $this->faker->numberBetween(1, 50),
            'seuil_alerte' => 10, // On fixe le seuil à 10 pour tester les alertes
            'user_id' => 1, // L'ID du premier utilisateur support
        ];
    }
}
