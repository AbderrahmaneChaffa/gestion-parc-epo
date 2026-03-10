<?php

namespace App\Http\Controllers;

use App\Models\Equipement;
use App\Models\Equipment;
use App\Models\Movement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MovementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $movements = Movement::with(['equipment', 'user'])->latest()->get();
        return view('movements.index', compact('movements'));
    }

    public function create()
    {
        $equipments = Equipement::all();
        return view('movements.create', compact('equipments'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'equipment_id' => 'required|exists:equipments,id',
            'type' => 'required|in:entree,sortie',
            'quantite' => 'required|integer|min:1',
            'direction_concernee' => 'nullable|string',
            'motif_ou_reference' => 'nullable|string',
            'date_mouvement' => 'required|date',
        ]);

        $equipment = Equipement::findOrFail($validated['equipment_id']);

        // Vérification de sécurité pour les sorties
        if ($validated['type'] === 'sortie' && $equipment->quantite_en_stock < $validated['quantite']) {
            return back()->withErrors(['quantite' => 'Erreur : Stock insuffisant pour cette sortie ! (Disponible : ' . $equipment->quantite_en_stock . ')'])->withInput();
        }

        DB::transaction(function () use ($validated, $equipment) {
            // Enregistrer le mouvement avec l'auteur (Support)
            $validated['user_id'] = Auth::id();
            Movement::create($validated);

            // Mise à jour de la quantité
            if ($validated['type'] === 'entree') {
                $equipment->increment('quantite_en_stock', $validated['quantite']);
            } else {
                $equipment->decrement('quantite_en_stock', $validated['quantite']);
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
