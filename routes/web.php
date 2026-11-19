<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\BrandPartnerController as AdminBrandPartnerController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\ClientController as AdminClientController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\HeroSlideController as AdminHeroSlideController;
use App\Http\Controllers\Admin\InquiryController as AdminInquiryController;
use App\Http\Controllers\Admin\PortfolioController as AdminPortfolioController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\SiteSettingController as AdminSiteSettingController;
use App\Http\Controllers\CompanyProfileController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\ProductController;
use App\Models\BrandPartner;
use App\Models\Category;
use App\Models\HeroSlide;
use App\Models\Product;
use App\Models\SiteSetting;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;

Route::get('/', function () {
    $heroSlides = Schema::hasTable('hero_slides')
        ? HeroSlide::query()->active()->ordered()->get()
        : collect();

    $homeCategories = Schema::hasTable('categories')
        ? Category::query()->active()->ordered()->get()
        : collect();

    $productLimit = max(1, (int) SiteSetting::getValue('home_products_limit', '8'));
    $featuredProducts = Schema::hasTable('products')
        ? Product::query()->with('category')->active()->featured()->ordered()->limit($productLimit)->get()
        : collect();

    $brandPartners = Schema::hasTable('brand_partners')
        ? BrandPartner::query()->active()->ordered()->get()
        : collect();

    return view('home', [
        'heroSlides' => $heroSlides,
        'homeCategories' => $homeCategories,
        'featuredProducts' => $featuredProducts,
        'brandPartners' => $brandPartners,
    ]);
})->name('home');

Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{slug}', [ProductController::class, 'show'])->name('products.show');

Route::get('/company-profile', [CompanyProfileController::class, 'index'])->name('company.profile');
Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery.index');
Route::get('/portfolio', [PortfolioController::class, 'index'])->name('portfolio.index');

Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

Route::prefix('admin')->name('admin.')->group(function (): void {
    Route::middleware('guest')->group(function (): void {
        Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
        Route::post('/login', [AuthController::class, 'authenticate'])->name('login.submit');
    });

    Route::middleware('auth')->group(function (): void {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

        // Inquiries & RFQs
        Route::get('/inquiries', [AdminInquiryController::class, 'index'])->name('inquiries.index');
        Route::get('/inquiries/{inquiry}', [AdminInquiryController::class, 'show'])->name('inquiries.show');
        Route::patch('/inquiries/{inquiry}/status', [AdminInquiryController::class, 'updateStatus'])->name('inquiries.status');
        Route::delete('/inquiries/{inquiry}', [AdminInquiryController::class, 'destroy'])->name('inquiries.destroy');

        // Products
        Route::resource('products', AdminProductController::class);

        // Categories
        Route::resource('categories', AdminCategoryController::class);

        // Brand Partners
        Route::resource('brand-partners', AdminBrandPartnerController::class)->parameters(['brand-partners' => 'brand_partner']);

        // Principle Corporate Clients
        Route::resource('clients', AdminClientController::class);

        // Portfolio Case Studies
        Route::resource('portfolios', AdminPortfolioController::class);

        // Hero Slides
        Route::resource('hero-slides', AdminHeroSlideController::class)->parameters(['hero-slides' => 'hero_slide']);

        // Site Settings
        Route::get('/settings', [AdminSiteSettingController::class, 'index'])->name('settings.index');
        Route::post('/settings', [AdminSiteSettingController::class, 'update'])->name('settings.update');
    });
});