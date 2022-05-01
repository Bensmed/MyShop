<?php

use App\Http\Controllers\Admin\ProductsController as AdminProductsController;
use App\Http\Controllers\Admin\CategoriesController as AdminCategoriesController;
use App\Http\Controllers\Admin\OrdersController as AdminOrdersController;
use App\Http\Controllers\Admin\SlidersController as AdminSlidersController;
use App\Http\Controllers\Admin\BannersController as AdminBannersController;
use App\Http\Controllers\Admin\CollectionController as AdminCollectionController;
use App\Http\Controllers\Admin\SettingsController as AdminSettingsController;
use App\Http\Controllers\Admin\CouponController as AdminCouponController;
use App\Http\Controllers\Admin\StatsController as AdminStatsController;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CartsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\SettingsController;
use Illuminate\Support\Facades\View;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');

Route::get('/', [HomeController::class, 'index'])->name('user.home');

Route::get('/a-propos', [HomeController::class, 'getAboutPage'])->name('about');

Route::get('/confidentialite', [HomeController::class, 'getSecurityPage'])->name('security');

Route::post('/processus/utilisateur/commande', [CartsController::class, 'processOrder']);

/*
*
*  'Mon panier' (Cart) group.
*
*/
Route::prefix('/mon-panier')->middleware('auth')->group(function () {

    Route::get('/', [CartsController::class, 'index'])->name('checkout');

    Route::post('/ajouter', [CartsController::class, 'store'])->name('cart');

    Route::get('/get/articles', [CartsController::class, 'getCartItemsForCheckout']);

    Route::post('/supprimer/article', [CartsController::class, 'deleteItem'])->name('deleteProduct');

    Route::get('/coupon/{code}', [CartsController::class, 'applyCoupon']);
});


/*
*
*  'Produit' (Product) Group.
*
*/
Route::prefix('/produit')->group(function () {

    Route::get('/', [HomeController::class, 'index']);

    Route::get('/{id}', [ProductsController::class, 'index']);

    Route::get('/{id}/{slug}', [ProductsController::class, 'index'])->name('product');

    Route::post('/get/article', [ProductsController::class, 'getProductInfo']);
});

/*
*
*  'Catégorie' (Category) Group.
*
*/
Route::prefix('/categorie')->group(function () {

    Route::get('/', [ProductsController::class, 'productsByCategory']);

    Route::get('/{id}', [ProductsController::class, 'productsByCategory']);

    Route::get('/{id}/{slug}', [ProductsController::class, 'productsByCategory'])->name('pbc');
});

/*
*
*  'Profil' (Profile) Group.
*
*/
Route::prefix('/profil')->middleware('auth')->group(function () {
    Route::get('/', [ProfileController::class, 'show'])->name('myProfile');

    Route::post('/modifier/sauvgarder', [ProfileController::class, 'update']);
});




/*
*
*  Admin Group.
*
*/
Route::prefix('/admin')->middleware('isAdmin')->name('admin.')->group(function () {

    Route::prefix('/utilisateurs')->name('utilisateur.')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('manageUsers');
        Route::post('/setAsAdmin', [UserController::class, 'changeRole']);
        Route::post('/setAsUser', [UserController::class, 'changeRole']);
        Route::post('/supprimer', [UserController::class, 'delete']);
    });

    Route::prefix('/produits')->name('produits.')->group(function () {
        Route::get('/', [AdminProductsController::class, 'index']);
        Route::post('/supprimer', [AdminProductsController::class, 'delete']);
        Route::get('/ajouter', [AdminProductsController::class, 'create']);
        Route::post('/ajouter/sauvgarder', [AdminProductsController::class, 'store']);
        Route::get('/modifier/{id}', [AdminProductsController::class, 'edit']);
        Route::post('/modifier/{id}/sauvgarder', [AdminProductsController::class, 'update']);
        Route::post('/{id}/stock', [AdminProductsController::class, 'stock']);
    });

    Route::prefix('/categories')->name('categories.')->group(function () {
        Route::get('/', [AdminCategoriesController::class, 'index']);
        Route::post('/supprimer', [AdminCategoriesController::class, 'delete']);
        Route::get('/ajouter', [AdminCategoriesController::class, 'create']);
        Route::post('/ajouter/sauvgarder', [AdminCategoriesController::class, 'store']);
        Route::get('/modifier/{id}', [AdminCategoriesController::class, 'edit']);
        Route::post('/modifier/{id}/sauvgarder', [AdminCategoriesController::class, 'update']);
    });

    Route::prefix('/ventes')->name('ventes.')->group(function () {
        Route::get('/', [AdminOrdersController::class, 'index']);
        Route::post('/statut', [AdminOrdersController::class, 'update']);
    });

    Route::prefix('/sliders')->name('sliders.')->group(function () {
        Route::get('/', [AdminSlidersController::class, 'index']);
        Route::post('/supprimer/{id}', [AdminSlidersController::class, 'destroy']);
        Route::get('/ajouter', [AdminSlidersController::class, 'create']);
        Route::post('/ajouter/sauvgarder', [AdminSlidersController::class, 'store']);
        Route::get('/modifier/{id}', [AdminSlidersController::class, 'edit']);
        Route::post('/modifier/{id}/sauvgarder', [AdminSlidersController::class, 'update']);
    });

    Route::prefix('/banner')->name('banner.')->group(function () {
        Route::get('/', [AdminBannersController::class, 'index']);
        Route::post('/supprimer/{id}', [AdminBannersController::class, 'destroy']);
        Route::get('/ajouter', [AdminBannersController::class, 'create']);
        Route::post('/ajouter/sauvgarder', [AdminBannersController::class, 'store']);
        Route::get('/modifier/{id}', [AdminBannersController::class, 'edit']);
        Route::post('/modifier/{id}/sauvgarder', [AdminBannersController::class, 'update']);
    });

    Route::prefix('/collections')->name('collections.')->group(function () {
        Route::get('/', [AdminCollectionController::class, 'index']);
        Route::post('/supprimer/{id}', [AdminCollectionController::class, 'destroy']);
        Route::get('/ajouter', [AdminCollectionController::class, 'create']);
        Route::post('/ajouter/sauvgarder', [AdminCollectionController::class, 'store']);
        Route::get('/modifier/{id}', [AdminCollectionController::class, 'edit']);
        Route::post('/modifier/{id}/sauvgarder', [AdminCollectionController::class, 'update']);
    });

    Route::prefix('/parametres')->name('parametres.')->group(function () {
        Route::get('/', [AdminSettingsController::class, 'index']);
        Route::post('/parametres-general/sauvgarder', [AdminSettingsController::class, 'saveGeneralSettings']);
        Route::post('/media-sociaux/sauvgarder', [AdminSettingsController::class, 'saveSocialSettings']);
        Route::post('/plus-parametres/sauvgarder', [AdminSettingsController::class, 'saveMoreSettings']);
        Route::post('/couleurs/sauvgarder', [AdminSettingsController::class, 'saveColorsSettings']);
        Route::post('/logo/sauvgarder', [AdminSettingsController::class, 'saveLogoSettings']);
    });

    Route::prefix('/coupons')->name('coupons.')->group(function () {
        Route::get('/', [AdminCouponController::class, 'index']);
        Route::post('/supprimer/{id}', [AdminCouponController::class, 'destroy']);
        Route::get('/ajouter', [AdminCouponController::class, 'create']);
        Route::post('/ajouter/sauvgarder', [AdminCouponController::class, 'store']);
        Route::get('/modifier/{id}', [AdminCouponController::class, 'edit']);
        Route::post('/modifier/{id}/sauvgarder', [AdminCouponController::class, 'update']);
    });

    Route::prefix('/statistique')->name('stats.')->group(function () {
        Route::get('/', [AdminStatsController::class, 'index']);
        Route::get('/chart', [AdminStatsController::class, 'getChartValues']);
        Route::get('/dernieresVentes', [AdminStatsController::class, 'getLatestSales']);
        Route::get('/dernieresProduits', [AdminStatsController::class, 'getLatestProducts']);
    });

    Route::prefix('/a-propos')->name('about.')->group(function () {
        Route::get('/', [AdminSettingsController::class, 'getAboutEditor']);
        Route::post('/sauvgarder', [AdminSettingsController::class, 'updateAboutPage']);
    });

    Route::prefix('/confidentialite')->name('security.')->group(function () {
        Route::get('/', [AdminSettingsController::class, 'getSecurityEditor']);
        Route::post('/sauvgarder', [AdminSettingsController::class, 'updateSecurityPage']);
    });
});
