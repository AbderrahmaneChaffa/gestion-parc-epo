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
    public function index()
    {
        $equipements = Equipement::with('user')->latest()->get();
        return view('equipements.index', compact('equipements'));
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
            'designation' => 'required|string|max:255',
            'categorie' => 'required|string',
            'seuil_alerte' => 'required|integer|min:0',
            'quantite_initiale' => 'required|integer|min:0',
        ]);

        $equipment = Equipement::create([
            'designation' => $validated['designation'],
            'categorie' => $validated['categorie'],
            'seuil_alerte' => $validated['seuil_alerte'],
            'quantite_en_stock' => $validated['quantite_initiale'],
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
            'designation' => 'required|string|max:255',
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
