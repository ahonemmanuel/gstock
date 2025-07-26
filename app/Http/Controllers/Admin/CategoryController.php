<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function inde()
    {
        $categories = Category::withCount('products')->paginate(10);

        return view('admin.categories', [
            'categories' => $categories,
            'totalCategories' => Category::count(),
            'activeCategories' => Category::active()->count(),
            'inactiveCategories' => Category::inactive()->count(),
            'emptyCategories' => Category::empty()->count()
        ]);
    }

    public function index()
    {
        $categories = Category::latest()->paginate(5);

        $total = Category::count();
        $actives = Category::where('is_active', true)->count();
        $averageProducts = 52; // À remplacer par un vrai calcul si tu as une relation avec `Product`
        $empty = Category::doesntHave('products')->count(); // si relation disponible

        return view('admin.categories', compact('categories', 'total', 'actives', 'averageProducts', 'empty'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:10|unique:categories',
            'description' => 'nullable|string',
            'icon' => 'required|string',
            'color' => 'required|string',
            'text_color' => 'required|string',
            'is_active' => 'boolean'
        ]);

        Category::create($validated);

        return redirect()->route('categories.index')
            ->with('success', 'Catégorie créée avec succès!');
    }

    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:10|unique:categories,code,'.$category->id,
            'description' => 'nullable|string',
            'icon' => 'required|string',
            'color' => 'required|string',
            'text_color' => 'required|string',
            'is_active' => 'boolean'
        ]);

        $category->update($validated);

        return redirect()->route('categories.index')
            ->with('success', 'Catégorie mise à jour avec succès!');
    }

    public function destroy(Category $category)
    {
        if ($category->products()->exists()) {
            return back()->with('error', 'Impossible de supprimer une catégorie avec des produits!');
        }

        $category->delete();
        return redirect()->route('categories.index')
            ->with('success', 'Catégorie supprimée avec succès!');
    }

    public function toggleStatus(Category $category)
    {
        $category->update(['is_active' => !$category->is_active]);
        return back()->with('success', 'Statut de la catégorie mis à jour!');
    }
}
