<?php

namespace App\Http\Controllers;

use App\Models\Equipement;
use App\Models\Movement;
use Illuminate\Http\Request;
use SweetAlert2\Laravel\Swal;

class DashboardController extends Controller
{
    public function index()
    {
        // ====== 1. STATISTIQUES GLOBALES ======

        $totalEquipements = Equipement::count();

        $totalMouvementsAujourdhui = Movement::whereDate('date_mouvement', today())
            ->count();

        // Mouvements par type (entrées et sorties du jour)
        $mouvementsEntree = Movement::where('type', 'entree')
            ->whereDate('date_mouvement', today())
            ->count();

        $mouvementsSortie = Movement::where('type', 'sortie')
            ->whereDate('date_mouvement', today())
            ->count();


        // ====== 2. ALERTES STOCK CRITIQUE ======
        // Équipements ayant atteint ou dépassé le seuil d'alerte
        $alertesStock = Equipement::whereColumn('quantite_en_stock', '<=', 'seuil_alerte')
            ->where('quantite_en_stock', '>', 0)  // Optionnel: exclure les ruptures totales
            ->orderBy('quantite_en_stock', 'asc')
            ->limit(10)
            ->get();


        // ====== 3. DERNIERS MOUVEMENTS AVEC TRAÇABILITÉ ======
        // Récupération des 15 derniers mouvements avec relations
        $derniersMouvements = Movement::with([
            'equipement:id,designation,categorie',  // Données équipement
            'user:id,name,email'                                  // Données responsable
        ])
            ->orderBy('date_mouvement', 'desc')
            ->orderBy('id', 'desc')  // En cas d'égalité sur la date
            ->limit(15)
            ->get();


        // ====== 4. STATISTIQUES SUPPLÉMENTAIRES (OPTIONNELLES) ======

        // Équipements les plus mouvementés (Top 5)
        $equipementsPlusActifs = Movement::select('equipement_id')
            ->whereDate('date_mouvement', '>=', today()->subDays(7))
            ->groupBy('equipement_id')
            ->orderByRaw('COUNT(*) DESC')
            ->with('equipement:id,designation')
            ->limit(5)
            ->get();

        // Taux de conformité (mouvements avec traçabilité complète)
        $totalMouvements = Movement::count();
        $mouvementsComplets = Movement::whereNotNull('user_id')
            ->whereNotNull('direction_concernee')
            ->count();
        $tauxConformite = $totalMouvements > 0
            ? round(($mouvementsComplets / $totalMouvements) * 100, 1)
            : 100;


        // ====== 5. RETOUR DES DONNÉES À LA VUE ======

        return view('dashboard', compact(
            'totalEquipements',
            'totalMouvementsAujourdhui',
            'mouvementsEntree',
            'mouvementsSortie',
            'alertesStock',
            'derniersMouvements',
            'equipementsPlusActifs',
            'tauxConformite'
        ));
    }
}
