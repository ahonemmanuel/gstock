<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;

use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Employe\EmployeDashboardController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\StockMovementController;
use App\Http\Controllers\VendeurCartController;
use App\Http\Controllers\VendeurPanierController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/e', function () {
    return view('admin.ts');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');






});

require __DIR__.'/auth.php';


Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('register', [RegisteredUserController::class, 'create'])
        ->name('register');
    Route::post('register', [RegisteredUserController::class, 'store']);

//gestion des categorie
    Route::resource('categories', CategoryController::class)->except(['show']);
    Route::post('/categories/{category}/toggle-status', [CategoryController::class, 'toggleStatus'])
        ->name('categories.toggle-status');

//gestioon des product

    Route::resource('products', ProductController::class);

    // Route pour l'export
    Route::get('products/export', [ProductController::class, 'export'])->name('products.export');


    //gestion des mouvements

    Route::resource('stock-movements', StockMovementController::class)->only([
        'index', 'store', 'destroy'
    ]);
});

Route::middleware(['auth', 'role:employe'])->group(function () {
});

Route::middleware(['auth', 'role:vendeur'])->group(function () {

    Route::get('/vendeur/produits', [\App\Http\Controllers\ProductController::class, 'index'])->name('vendeur.produits');
    Route::get('/vendeur/dashboard', [EmployeDashboardController::class, 'index'])->name('vendeur.dashboard');


    Route::prefix('cart')->group(function() {
        Route::post('/items', [VendeurCartController::class, 'addToCart'])->name('vendeur.cart.add');
        Route::post('/checkout', [VendeurCartController::class, 'checkout'])->name('vendeur.cart.checkout');
        Route::post('/save', [VendeurCartController::class, 'save'])->name('save');
        Route::get('/', [VendeurCartController::class, 'viewCart'])->name('vendeur.cart.view');

        //Route::put('/items/{cartItem}', [VendeurCartController::class, 'updateCart'])->name('vendeur.cart.update');
     //   Route::delete('/items/{cartItem}', [VendeurCartController::class, 'removeFromCart'])->name('vendeur.cart.remove');

            Route::post('/update/{id}', [CartController::class, 'updateQuantity'])->name('cart.update');
            Route::delete('/remove/{id}', [CartController::class, 'removeItem'])->name('cart.remove');


    });
});
