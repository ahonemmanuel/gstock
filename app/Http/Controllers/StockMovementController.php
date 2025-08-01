<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\StockMovement;
use Illuminate\Http\Request;

class StockMovementController extends Controller
{
    public function index(Request $request)
    {
        $query = StockMovement::with('product');

        // Filtrage
        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        if ($request->filled('product_id')) {
            $query->where('product_id', $request->product_id);
        }

        if ($request->filled('start_date')) {
            $query->where('movement_date', '>=', $request->start_date);
        }

        if ($request->filled('end_date')) {
            $query->where('movement_date', '<=', $request->end_date . ' 23:59:59');
        }

        $movements = $query->latest()->paginate(10);
        $products = Product::all();

        return view('admin.move', compact('movements', 'products'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'type' => 'required|in:entree,sortie,transfert,ajustement',
            'movement_date' => 'required|date',
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'source_location' => 'nullable|required_if:type,sortie,transfert,ajustement|string',
            'destination_location' => 'nullable|required_if:type,entree,transfert|string',
            'notes' => 'nullable|string'
        ]);

        // Génération de la référence
        $latest = StockMovement::latest()->first();
        $reference = 'MV-' . date('Y') . '-' . str_pad($latest ? $latest->id + 1 : 1, 4, '0', STR_PAD_LEFT);

        StockMovement::create([
            'reference' => $reference,
            'movement_date' => $validated['movement_date'],
            'type' => $validated['type'],
            'product_id' => $validated['product_id'],
            'quantity' => $validated['quantity'],
            'source_location' => $validated['source_location'] ?? null,
            'destination_location' => $validated['destination_location'] ?? null,
            'responsible' => auth()->user()->name,
            'notes' => $validated['notes'] ?? null
        ]);

        return redirect()->route('stock-movements.index')->with('success', 'Mouvement créé avec succès!');
    }

    public function destroy(StockMovement $stockMovement)
    {
        $stockMovement->delete();
        return redirect()->route('stock-movements.index')->with('success', 'Mouvement supprimé avec succès!');
    }
    /**
     * Display a listing of the resource.
     */


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

    /**
     * Display the specified resource.
     */
    public function show(StockMovement $stockMovement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(StockMovement $stockMovement)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, StockMovement $stockMovement)
    {
        //
    }


}
