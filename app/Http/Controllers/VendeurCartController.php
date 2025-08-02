<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class VendeurCartController extends Controller
{
    public function updateCart(Request $request, CartItem $item)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        // Verify the item belongs to the user's cart
        if ($item->cart->user_id !== Auth::id()) {
            abort(403);
        }

        $item->update([
            'quantity' => $request->quantity
        ]);

        return response()->json(['success' => true]);
    }

    public function removeFromCart(CartItem $item)
    {
        // Verify the item belongs to the user's cart
        if ($item->cart->user_id !== Auth::id()) {
            abort(403);
        }

        $item->delete();

        return response()->json(['success' => true]);
    }

    public function addToCat(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);

        $user = Auth::user();
        $product = Product::findOrFail($request->product_id);

        if ($product->quantity <= 0) {

            return response()->json(['success' => false, 'message' => 'Produit en rupture de stock.']);
        }
        // Check if user has an active cart
        $cart = Cart::firstOrCreate([
            'user_id' => $user->id,
            'status' => 'pending'
        ]);

        // Check if product already exists in cart
        $cartItem = CartItem::where('cart_id', $cart->id)
            ->where('product_id', $product->id)
            ->first();

        if ($cartItem) {
            $cartItem->increment('quantity');
        } else {
            CartItem::create([
                'cart_id' => $cart->id,
                'product_id' => $product->id,
                'quantity' => 1
            ]);
        }


        return response()->json([
            'success' => true,
            'cart_count' => $cart->items()->count(),
            'product_id' => $product->id,
            'quantity' => $product->quantity, // utile pour bloquer le bouton si nécessaire
        ]);

    }

    public function addToCart(Request $request)
    {
        $user = auth()->user();
        $product = Product::findOrFail($request->product_id);

        // Vérifie si le produit est disponible
        if ($product->quantity <= 0) {
            return response()->json(['success' => false, 'message' => 'Produit en rupture de stock.']);
        }

        // Récupère ou crée le panier de l'utilisateur
        $cart = Cart::firstOrCreate([
            'user_id' => $user->id,
            'status' => 'pending'
        ]);

        // Vérifie si le produit est déjà dans le panier
        $item = $cart->items()->where('product_id', $product->id)->first();

        if ($item) {

            // Vérifie si on peut encore en ajouter (ex: stock >= quantité actuelle + 1)
            if ($product->quantity < ($item->quantity + 1)) {
                return response()->json(['success' => false, 'message' => 'Quantité maximale atteinte.']);
            }

            $item->quantity += 1;
            $item->save();
        } else {
            $cart->items()->create([
                'product_id' => $product->id,
                'quantity' => 1,
                'price' => $product->price
            ]);
        }

        // Réduit la quantité du stock produit
        $product->decrement('quantity');

        // Retourne le nombre d'items total dans le panier
        $cartCount = $cart->items->sum('quantity');

        return response()->json([
            'success' => true,
            'cart_count' => $cartCount
        ]);
    }


    public function viewCart()
    {
        $user = Auth::user();
        $cart = Cart::with('items.product')->where('user_id', $user->id)
            ->where('status', 'pending')
            ->first();

        return view('vendeur.cart', compact('cart'));
    }


    public function checkout(Request $request)
    {
        $user = Auth::user();

        // Récupère le panier avec les items
        $cart = Cart::with('items')->where('user_id', $user->id)
            ->where('status', 'pending')
            ->firstOrFail();

        DB::beginTransaction();

        try {
            foreach ($cart->items as $item) {
                // Verrouille la ligne produit pour éviter les conflits concurrents
                $product = DB::table('products')
                    ->where('id', $item->product_id)
                    ->lockForUpdate()
                    ->first();

                if (!$product) {
                    DB::rollBack();
                    return back()->with('error', "Produit introuvable pour l'article ID {$item->id}");
                }

                if ($product->quantity < $item->quantity) {
                    DB::rollBack();
                    return back()->with('error', "Stock insuffisant pour le produit {$product->name}");
                }

                // Mise à jour de la quantité du produit
                DB::table('products')->where('id', $product->id)
                    ->decrement('quantity', $item->quantity);
            }

            // Mise à jour du statut du panier
            $cart->update(['status' => 'completed']);

            DB::commit();

            return redirect()->route('vendeur.produits')
                ->with('success', 'Vente finalisée avec succès');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Erreur lors du traitement de la commande : ' . $e->getMessage());
        }
    }

}
