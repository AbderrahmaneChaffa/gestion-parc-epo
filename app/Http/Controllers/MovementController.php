<?php

namespace App\Http\Controllers;


use App\Models\Equipement;
use App\Models\Movement;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MovementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function index()
    // {
    //     $movements = Movement::with(['equipement', 'user'])->latest()->get();
    //     return view('movements.index', compact('movements'));
    // }
    /**
     * Affiche la liste complète des mouvements avec filtres et recherche
     */
    public function index(Request $request)
    {
        // ====== STATISTIQUES GLOBALES ======
        $totalMouvements = Movement::count();
        $totalEntrees = Movement::where('type', 'entree')->count();
        $totalSorties = Movement::where('type', 'sortie')->count();
        $mouvementsAujourdhui = Movement::whereDate('created_at', today())->count();

        // ====== OPTIONS POUR LES FILTRES ======
        // Récupérer les directions disponibles
        $directions = Movement::distinct()->pluck('direction_concernee')->filter()->values()->toArray();

        // Récupérer les catégories disponibles via les équipements
        $categories = Equipement::distinct()->pluck('categorie')->filter()->values()->toArray();

        // ====== CONSTRUCTION DE LA REQUÊTE DE BASE ======
        $query = Movement::with(['equipement', 'user']);

        // ====== FILTRAGE - Recherche ======
        $search = $request->input('search');
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->whereHas('equipement', function ($subQ) use ($search) {
                    $subQ->where('designation', 'LIKE', "%{$search}%")
                        ->orWhere('reference', 'LIKE', "%{$search}%");
                })
                    ->orWhere('direction_concernee', 'LIKE', "%{$search}%");
            });
        }

        // ====== FILTRAGE - Type (Entrée/Sortie) ======
        $type = $request->input('type');
        if ($type && in_array($type, ['entree', 'sortie'])) {
            $query->where('type', $type);
        }

        // ====== FILTRAGE - Direction ======
        $direction = $request->input('direction');
        if ($direction) {
            $query->where('direction_concernee', $direction);
        }

        // ====== FILTRAGE - Catégorie (via équipement) ======
        $category = $request->input('category');
        if ($category) {
            $query->whereHas('equipement', function ($q) use ($category) {
                $q->where('categorie', $category);
            });
        }

        // ====== FILTRAGE - Période ======
        $period = $request->input('period');
        if ($period) {
            switch ($period) {
                case 'today':
                    $query->whereDate('date_mouvement', today());
                    break;
                case 'week':
                    $query->whereBetween('date_mouvement', [
                        Carbon::now()->startOfWeek(),
                        Carbon::now()->endOfWeek()
                    ]);
                    break;
                case 'month':
                    $query->whereMonth('date_mouvement', Carbon::now()->month)
                        ->whereYear('date_mouvement', Carbon::now()->year);
                    break;
            }
        }

        // ====== TRI ET PAGINATION ======
        $mouvements = $query->latest('date_mouvement')->paginate(20);

        return view('movements.index', compact(
            'mouvements',
            'totalMouvements',
            'totalEntrees',
            'totalSorties',
            'mouvementsAujourdhui',
            'directions',
            'categories'
        ));
    }
    public function create()
    {
        $equipements = Equipement::all();
        return view('movements.create', compact('equipements'));
    }

    /**
     * Store a newly created resource in storage.
     */
    // Enregistrer le mouvement et mettre à jour le stock
    public function store(Request $request)
    {
        $validated = $request->validate([
            'equipement_id' => 'required|exists:equipements,id',
            'type' => 'required|in:entree,sortie',
            'quantite' => 'required|integer|min:1',
            'direction_concernee' => 'nullable|string',
            'motif_ou_reference' => 'nullable|string',
            'date_mouvement' => 'required|date',
        ]);

        $equipement = Equipement::findOrFail($validated['equipement_id']);

        // Vérification de sécurité pour les sorties
        if ($validated['type'] === 'sortie' && $equipement->quantite_en_stock < $validated['quantite']) {
            return back()->withErrors(['quantite' => 'Erreur : Stock insuffisant pour cette sortie ! (Disponible : ' . $equipement->quantite_en_stock . ')'])->withInput();
        }

        DB::transaction(function () use ($validated, $equipement) {
            // Enregistrer le mouvement avec l'auteur (Support)
            $validated['user_id'] = Auth::id();
            Movement::create($validated);

            // Mise à jour de la quantité
            if ($validated['type'] === 'entree') {
                $equipement->increment('quantite_en_stock', $validated['quantite']);
            } else {
                $equipement->decrement('quantite_en_stock', $validated['quantite']);
            }
        });

        return redirect()->route('dashboard')->with('success', 'Stock mis à jour avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Movement $movement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Movement $movement)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Movement $movement)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Movement $movement)
    {
        //
    }
}
