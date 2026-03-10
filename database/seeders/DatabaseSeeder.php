<?php

namespace Database\Seeders;

use App\Models\Equipement;
use App\Models\Equipment;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // Créer un utilisateur Support
        $user = User::factory()->create([
            'name' => 'Support EPO',
            'email' => 'support@epo.dz',
            'password' => bcrypt('password'),
        ]);

        // Créer des équipements
        Equipement::create([
            'designation' => 'PC Portable Dell',
            'categorie' => 'Informatique',
            'quantite_en_stock' => 20,
            'seuil_alerte' => 5,
            'user_id' => $user->id,
        ]);
    }
}
