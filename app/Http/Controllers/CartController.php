<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{

    public function getCart(Request $request)
    {
        $cart = session()->get('cart', []);
        $items = [];
        $total = 0;

        foreach ($cart as $productId => $quantity) {
            $product = Product::find($productId);
            if ($product) {
                $price = $product->promotion
                    ? $product->price * (1 - $product->promotion / 100)
                    : $product->price;

                $items[] = [
                    'id' => $product->id,
                    'name' => $product->name,
                    'price' => $price,
                    'icon' => $product->icon,
                    'image' => $product->image,
                    'quantity' => $quantity
                ];

                $total += $price * $quantity;
            }
        }

        return response()->json([
            'items' => $items,
            'total' => $total
        ]);
    }

    public function addToCart(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id'
        ]);

        $product = Product::findOrFail($request->product_id);

        // Vérifier le stock
        if ($product->stock_status === 'rupture_stock') {
            return response()->json([
                'error' => 'Ce produit est en rupture de stock'
            ], 400);
        }

        $cart = session()->get('cart', []);

        if (isset($cart[$product->id])) {
            $cart[$product->id]++;
        } else {
            $cart[$product->id] = 1;
        }

        session()->put('cart', $cart);

        return response()->json([
            'message' => 'Produit ajouté au panier',
            'product' => $product
        ]);
    }

    public function removeFromCart(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id'
        ]);

        $cart = session()->get('cart', []);

        if (isset($cart[$request->product_id])) {
            unset($cart[$request->product_id]);
            session()->put('cart', $cart);
        }

        return response()->json([
            'message' => 'Produit retiré du panier'
        ]);
    }

    public function updateCart(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1'
        ]);

        $product = Product::findOrFail($request->product_id);

        // Vérifier le stock
        if ($request->quantity > $product->stock_quantity && $product->stock_status !== 'illimite') {
            return response()->json([
                'error' => 'Quantité demandée non disponible en stock'
            ], 400);
        }

        $cart = session()->get('cart', []);

        if ($request->quantity <= 0) {
            unset($cart[$request->product_id]);
        } else {
            $cart[$request->product_id] = $request->quantity;
        }

        session()->put('cart', $cart);

        return response()->json([
            'message' => 'Panier mis à jour'
        ]);
    }

    public function clearCart()
    {
        session()->forget('cart');

        return response()->json([
            'message' => 'Panier vidé'
        ]);
    }


    public function checkout()
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return response()->json([
                'error' => 'Le panier est vide'
            ], 400);
        }

        try {
            // 1. Créer la commande
            $order = Auth::user()->orders()->create([
                'total' => $this->calculateCartTotal($cart),
                'status' => 'pending'
            ]);

            // 2. Ajouter les produits de la commande
            foreach ($cart as $productId => $quantity) {
                $product = Product::find($productId);

                $order->products()->attach($productId, [
                    'quantity' => $quantity,
                    'unit_price' => $product->price,
                    'promotion' => $product->promotion
                ]);
            }

            // 3. Vider le panier
            session()->forget('cart');

            return response()->json([
                'message' => 'Commande passée avec succès',
                'redirect' => route('vendeur.commandes.show', $order->id)
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Erreur lors de la commande: ' . $e->getMessage()
            ], 500);
        }
    }

    private function calculateCartTotal($cart)
    {
        $total = 0;

        foreach ($cart as $productId => $quantity) {
            $product = Product::find($productId);
            $price = $product->promotion
                ? $product->price * (1 - $product->promotion / 100)
                : $product->price;
            $total += $price * $quantity;
        }

        return $total + 5.99; // Ajouter les frais de livraison
    }
    public function add(Product $product)
    {
        // Validation du stock
        if ($product->quantity < 1) {
            return back()->with('error', 'Produit en rupture de stock');
        }

        // Ajouter au panier (exemple basique)
        $cart = session()->get('cart', []);

        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity']++;
        } else {
            $cart[$product->id] = [
                'name' => $product->name,
                'price' => $product->price,
                'image' => $product->image,
                'quantity' => 1
            ];
        }

        session()->put('cart', $cart);

        return back()->with('success', 'Produit ajouté au panier');
    }
}
