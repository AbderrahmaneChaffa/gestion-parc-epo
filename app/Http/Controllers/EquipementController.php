<?php

namespace App\Http\Controllers;

use App\Models\Equipement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EquipementController extends Controller
{


    /**
     * Store a newly created resource in storage.
     */
    // public function index(Request $request)
    // {
    //     $alertesStock = Equipement::whereColumn('quantite_en_stock', '<=', 'seuil_alerte')
    //         ->orderBy('quantite_en_stock', 'asc')
    //         ->get();

    //     $search = $request->input('search');

    //     // On commence la requête avec la relation user
    //     $query = Equipement::with('user');

    //     // Si une recherche est effectuée
    //     if ($search) {
    //         $query->where(function ($q) use ($search) {
    //             $q->where('designation', 'LIKE', "%{$search}%")
    //                 ->orWhere('categorie', 'LIKE', "%{$search}%");
    //         });
    //     }

    //     $equipements = $query->latest()->paginate(10); // Ajout de la pagination pour plus de clarté

    //     return view('equipements.index', compact('equipements', 'search', 'alertesStock'));
    // }
    public function index(Request $request)
    {
        // Récupérer les paramètres de recherche et filtrage
        $search = $request->input('search');
        $categorie = $request->input('categorie');
        $stock_status = $request->input('stock_status');
        // Categories 
        $categories = Equipement::pluck('categorie')->unique()->filter();

        // Récupérer les équipements en alerte (statut critique)
        $alertesStock = Equipement::whereColumn('quantite_en_stock', '<=', 'seuil_alerte')
            ->where('quantite_en_stock', '>', 0)  // Optionnel: exclure les ruptures totales
            ->orderBy('quantite_en_stock', 'asc')
            // ->limit(10)
            ->get();
        $enstockBon = Equipement::whereColumn('quantite_en_stock', '>', 'seuil_alerte')->count();
        $enstockcritique = Equipement::whereColumn('quantite_en_stock', '<=', 'seuil_alerte')->count();

        // Commencer la requête avec la relation user
        $query = Equipement::with('user');

        // FILTRAGE - Recherche par désignation ou référence
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('designation', 'LIKE', "%{$search}%")
                    ->orWhere('categorie', 'LIKE', "%{$search}%");
            });
        }

        // FILTRAGE - Catégorie
        if ($categorie && $categorie !== '') {
            $query->where('categorie', $categorie);
        }

        // FILTRAGE - Statut du stock
        // if ($stock_status && $stock_status !== '') {
        //     if ($stock_status === 'critique') {
        //         // Stock critique: quantité <= seuil d'alerte
        //         $query->whereColumn('quantite_en_stock', '<=', 'seuil_alerte');
        //     } elseif ($stock_status === 'bon') {
        //         // Stock bon: quantité > seuil d'alerte
        //         $query->whereColumn('quantite_en_stock', '>', 'seuil_alerte');
        //     }
        // }

        // Tri et pagination
        $equipements = $query
            ->orderBy('designation', 'asc')
            ->paginate(10)
            ->appends($request->query()); // Préserver les filtres lors de la pagination

        return view('equipements.index', compact(
            'equipements',
            'search',
            'categorie',
            'stock_status',
            'alertesStock',
            'categories',
            'enstockBon',
            'enstockcritique'
        ));
    }
    public function create()
    {
        return view('equipements.create');
    }

    // public function store(Request $request)
    // {
    //     $validated = $request->validate([
    //         'designation' => 'required|string|max:255',
    //         'categorie' => 'required|string',
    //         'quantite_en_stock' => 'required|integer|min:0',
    //         'seuil_alerte' => 'required|integer|min:0',
    //     ]);

    //     $validated['user_id'] = Auth::id();
    //     Equipement::create($validated);

    //     return redirect()->route('equipements.index')->with('success', 'Matériel ajouté.');
    // }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'designation' => 'required|string|max:255|unique:equipements,designation',
            'categorie' => 'required|string',
            'seuil_alerte' => 'required|integer|min:0',
            //'quantite_initiale' => 'required|integer|min:0',
        ]);

        $equipement = Equipement::create([
            'designation' => $validated['designation'],
            'categorie' => $validated['categorie'],
            'seuil_alerte' => $validated['seuil_alerte'],
            'quantite_en_stock' => 0, // Initialement à 0, sera mis à jour lors de l'ajout de mouvements
            'user_id' => Auth::id(), // Traçabilité de création
        ]);

        return redirect()->route('equipements.index')->with('success', 'Matériel ajouté au catalogue.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Equipement $equipement)
    {
        //
    }



    public function edit(Equipement $equipement)
    {
        return view('equipements.edit', compact('equipement'));
    }

    public function update(Request $request, Equipement $equipement)
    {
        $validated = $request->validate([
            'designation' => 'required|string|max:255|unique:equipements,designation',
            'categorie' => 'required|string',
            'seuil_alerte' => 'required|integer|min:0',
        ]);

        $equipement->update($validated);

        return redirect()->route('equipements.index')->with('success', 'Matériel mis à jour.');
    }

    public function destroy(Equipement $equipement)
    {
        $equipement->delete();
        return redirect()->route('equipements.index')->with('success', 'Matériel supprimé.');
    }
}
