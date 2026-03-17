<?php

namespace Database\Seeders;

use App\Models\Equipement;
use App\Models\Equipment;
use App\Models\Movement;
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
        // 2. Créer 15 équipements différents
        Equipement::factory(50)->create();

        // 3. Créer 30 mouvements d'entrées/sorties
        Movement::factory(30)->create();
    }
}
