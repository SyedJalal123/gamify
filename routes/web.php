<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\Auth\FacebookController;
use App\Models\Item;
use App\Models\Category;
use App\Models\BuyerRequest;
use App\Models\Game;
use App\Models\Seller;
use App\Http\Controllers\NowPaymentController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\StripeController;
use App\Notifications\BoostingOfferNotification;
use Illuminate\Support\Facades\Notification;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/clear-cache', function () {
    Artisan::call('config:clear');
    Artisan::call('cache:clear');
    Artisan::call('optimize:clear');
    Artisan::call('view:clear');
    Artisan::call('config:cache');
    return "Config and cache cleared!";
});

Route::middleware('verified')->group(function () {
    Route::get('/', function () {
        $categories = Category::with('games')->get();
        return view('frontend.home', compact('categories'));
    });
    Route::get('/seller-verification', function () {
        return view('frontend.seller_verification');
    });
    Route::post('/seller-verification', [SellerController::class, 'verification'])->name('seller.verify');

    // Get Data for Item
    Route::get('/get-games', [ItemController::class, 'getGames']);
    Route::get('/get-attributes', [ItemController::class, 'getAttributes']);

    // Item Routes
    Route::get('/items/create', [ItemController::class, 'create'])->name('items.create')->middleware(['auth']);
    Route::post('/items/store', [ItemController::class, 'store'])->name('items.store')->middleware(['auth']);
    Route::get('/toggle-service', [ItemController::class, 'toggleService'])->name('service.toggle')->middleware(['auth']);

    // Catalog Routes
    Route::get('catalog/{category_id}', [CatalogController::class, 'index'])->name('catalog.index');
    Route::get('/get-item-details/{id}', [CatalogController::class, 'getItemDetails'])->name('get.item.details');
    Route::get('/live-search', [CatalogController::class, 'liveSearch'])->name('live.search');
    Route::get('/item/{item}', [CatalogController::class, 'itemDetail'])->name('item.detail');
    
    //Boosting Services Routes
    Route::get('/save-service', [ServiceController::class, 'store'])->middleware(['auth']);
    Route::get('/get-service-attributes', [ServiceController::class, 'getServiceAttributes']);
    Route::get('/boosting-request/{id}', [ServiceController::class, 'boostingRequest'])->middleware(['auth']);
    Route::post('/create-offer', [ServiceController::class, 'create_offer'])->name('offer.create')->middleware(['auth']);


    // Checkout Routes
    Route::get('/checkout', [CheckoutController::class, 'show'])->name('checkout');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Google authenticaiton routes
Route::get('auth/google', [GoogleController::class, 'redirectToGoogle']);
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);

// Facbook authenticaiton routes
Route::get('auth/facebook', [FacebookController::class, 'redirectToFacebook']);
Route::get('auth/facebook/callback', [FacebookController::class, 'handleFacebookCallback']);

// Paypal authenticaiton routes 
Route::get('/paypal/success', [PayPalController::class, 'success'])->name('paypal.success');
Route::get('/paypal/cancel', [PayPalController::class, 'cancel'])->name('paypal.cancel');

// NowPayment routes
Route::get('/pay/now', [NowPaymentController::class, 'create'])->name('nowpayments.create');
Route::post('/payment/now/callback', [NowPaymentController::class, 'callback'])->name('nowpayments.callback');
Route::get('/payment/success', [NowPaymentController::class, 'success'])->name('nowpayments.success');
Route::get('/payment/cancel', [NowPaymentController::class, 'cancel'])->name('nowpayments.cancel');

// Stripe Checkout Routes
Route::prefix('payment/stripe')->group(function () {

    Route::post('/create-session', [StripeController::class, 'createCheckoutSession'])->name('stripe.session');

    Route::get('/success', [StripeController::class, 'success'])->name('stripe.success');
    Route::get('/cancel', [StripeController::class, 'cancel'])->name('stripe.cancel');
});

require __DIR__.'/auth.php';
