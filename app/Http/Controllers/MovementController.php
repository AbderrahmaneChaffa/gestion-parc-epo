<?php

namespace App\Http\Controllers;

use App\Models\Equipement;
use App\Models\Equipment;
use App\Models\Movement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MovementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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

        DB::transaction(function () use ($validated) {
            Movement::create($validated);

            $equipment = Equipement::lockForUpdate()->findOrFail($validated['equipment_id']);

            if ($validated['type'] === 'entree') {
                $equipment->increment('quantite_en_stock', $validated['quantite']);
            } else {
                if ($equipment->quantite_en_stock < $validated['quantite']) {
                    abort(400, "Stock insuffisant.");
                }
                $equipment->decrement('quantite_en_stock', $validated['quantite']);
            }
        });

        return redirect()->back()->with('success', 'Mouvement enregistré avec succès.');
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
