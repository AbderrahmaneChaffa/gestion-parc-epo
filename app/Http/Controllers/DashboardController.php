<?php

namespace App\Http\Controllers;

use App\Models\Equipement;
use App\Models\Movement;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Statistiques globales
        $totalEquipements = Equipement::count();
        $totalMouvementsAujourdhui = Movement::whereDate('created_at', today())->count();

        // 2. Récupérer les équipements sous le seuil d'alerte
        $alertesStock = Equipement::whereColumn('quantite_en_stock', '<=', 'seuil_alerte')
            ->orderBy('quantite_en_stock', 'asc')
            ->get();

        // 3. Derniers mouvements avec relations (Equipment et User pour la traçabilité)
        $derniersMouvements = Movement::with(['equipment', 'user'])
            ->latest()
            ->take(10)
            ->get();

        return view('dashboard', compact(
            'totalEquipements',
            'totalMouvementsAujourdhui',
            'alertesStock',
            'derniersMouvements'
        ));
    }
}
