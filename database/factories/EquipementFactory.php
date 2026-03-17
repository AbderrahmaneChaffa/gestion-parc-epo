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
        $marques = ['Dell', 'HP', 'Lenovo', 'Asus', 'Cisco', 'Logitech', 'Samsung', 'APC', 'Epson', 'Canon'];
        $modeles = ['Latitude', 'EliteBook', 'ProDesk', 'ThinkPad', 'Precision', 'OptiPlex', 'Catalyst'];

        // On crée une liste variée pour simuler un vrai parc informatique
        $designations = [
            // PC & Laptops
            'Ordinateur Portable ' . $this->faker->randomElement($marques) . ' ' . $this->faker->randomElement($modeles),
            'Unité Centrale ' . $this->faker->randomElement($marques) . ' ' . $this->faker->randomElement($modeles),
            'Station de travail ' . $this->faker->randomElement($marques) . ' Z-Series',

            // Périphériques d'affichage
            'Écran ' . $this->faker->randomElement($marques) . ' 24 pouces LED',
            'Écran ' . $this->faker->randomElement($marques) . ' 27 pouces 4K',
            'Vidéoprojecteur Epson EB-X41',

            // Impression & Consommables
            'Imprimante LaserJet ' . $this->faker->randomElement(['Pro M404', 'Enterprise M507', 'Color M255']),
            'Photocopieur Multifonction Canon iR',
            'Toner HP ' . $this->faker->numberBetween(10, 99) . 'A Black',
            'Cartouche Encre Canon ' . $this->faker->numberBetween(500, 599) . ' XL',

            // Réseaux & Serveurs
            'Switch ' . $this->faker->randomElement(['Cisco Catalyst 24 ports', 'TP-Link 16 ports', 'D-Link Rackmount']),
            'Routeur Firewall Fortinet 60F',
            'Serveur Rack ' . $this->faker->randomElement(['PowerEdge R740', 'ProLiant DL380']),
            'Onduleur APC Smart-UPS 1500VA',

            // Accessoires
            'Clavier USB Logitech K120',
            'Souris Optique Sans fil',
            'Disque Dur Externe 1To WD',
            'Casque Audio avec Micro Jabra'
        ];

        return [
            // L'utilisation de unique() ici est CRUCIALE pour éviter l'erreur SQL
            'designation' => $this->faker->unique()->randomElement($designations) . ' (SN: ' . strtoupper($this->faker->bothify('??###??')) . ')',
            'categorie' => $this->faker->randomElement(['Informatique', 'Consommable', 'Périphérique', 'Réseau']),
            'quantite_en_stock' => $this->faker->numberBetween(0, 100),
            'seuil_alerte' => $this->faker->randomElement([5, 10, 15]),
            'user_id' => 1,
        ];
    }
}
