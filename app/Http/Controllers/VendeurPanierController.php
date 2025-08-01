<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class VendeurPanierController extends Controller
{
    public function ajouter(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);

        $user = Auth::user();
        $product = Product::findOrFail($request->product_id);

        // Vérifier le stock
        if ($product->quantity < 1) {
            return back()->with('error', 'Produit en rupture de stock');
        }

        // Récupérer ou créer le panier
        $cart = Cart::firstOrCreate([
            'user_id' => $user->id,
            'status' => 'pending'
        ]);

        // Ajouter ou mettre à jour l'article
        $cartItem = CartItem::firstOrNew([
            'cart_id' => $cart->id,
            'product_id' => $product->id
        ]);

        $cartItem->quantity += 1;
        $cartItem->save();

        return back()->with('success', 'Produit ajouté au panier');
    }

    public function retirer(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);

        $user = Auth::user();
        $product = Product::findOrFail($request->product_id);

        // Récupérer le panier actif de l'utilisateur
        $cart = Cart::where('user_id', $user->id)
            ->where('status', 'pending')
            ->first();

        if (!$cart) {
            return response()->json([
                'success' => false,
                'message' => 'Aucun panier trouvé'
            ], 404);
        }

        // Trouver l'article correspondant dans le panier
        $cartItem = $cart->items()->where('product_id', $product->id)->first();

        if (!$cartItem) {
            return response()->json([
                'success' => false,
                'message' => 'Produit non trouvé dans le panier'
            ], 404);
        }

        DB::beginTransaction();
        try {
            if ($cartItem->quantity > 1) {
                // Diminuer la quantité si > 1
                $cartItem->decrement('quantity');
            } else {
                // Supprimer l'article si quantité = 1
                $cartItem->delete();

                // Supprimer le panier s'il est vide
                if ($cart->items()->count() === 0) {
                    $cart->delete();
                }
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'cart_count' => $user->carts()->where('status', 'pending')->first()?->items->sum('quantity') ?? 0,
                'message' => 'Produit retiré du panier'
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la suppression du produit'
            ], 500);
        }
    }

    public function vider(Request $request)
    {
        $user = Auth::user();

        // Récupérer le panier actif
        $cart = Cart::where('user_id', $user->id)
            ->where('status', 'pending')
            ->first();

        if (!$cart) {
            return response()->json([
                'success' => false,
                'message' => 'Aucun panier à vider'
            ], 404);
        }

        DB::beginTransaction();
        try {
            // Supprimer tous les articles du panier
            $cart->items()->delete();
            // Supprimer le panier lui-même
            $cart->delete();

            DB::commit();

            return response()->json([
                'success' => true,
                'cart_count' => 0,
                'message' => 'Panier vidé avec succès'
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la suppression du panier'
            ], 500);
        }
    }

    public function valider(Request $request)
    {
        $user = Auth::user();

        // Récupérer le panier avec ses articles et les produits associés
        $cart = Cart::with(['items.product'])
            ->where('user_id', $user->id)
            ->where('status', 'pending')
            ->first();

        if (!$cart || $cart->items->isEmpty()) {
            return redirect()->back()->with('error', 'Le panier est vide');
        }

        // Vérifier les stocks avant validation
        foreach ($cart->items as $item) {
            if ($item->product->quantity < $item->quantity) {
                return redirect()->back()->with('error',
                    "Stock insuffisant pour le produit '{$item->product->name}'. Stock disponible: {$item->product->quantity}");
            }
        }

        DB::beginTransaction();
        try {
            // Mettre à jour les stocks
            foreach ($cart->items as $item) {
                $item->product->decrement('quantity', $item->quantity);
            }

            // Marquer le panier comme complété
            $cart->update(['status' => 'completed']);

            // Ici vous pourriez créer une commande dans une table 'orders'
            // $order = Order::create([...]);

            DB::commit();

            return redirect()->route('vendeur.produits')
                ->with('success', 'Commande validée avec succès!');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Une erreur est survenue lors de la validation de la commande');
        }
    }
}
