<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BrandPartner;
use App\Models\Category;
use App\Models\Client;
use App\Models\HeroSlide;
use App\Models\Inquiry;
use App\Models\Portfolio;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $hasProducts = Schema::hasTable('products');
        $hasCategories = Schema::hasTable('categories');
        $hasInquiries = Schema::hasTable('inquiries');
        $hasPortfolios = Schema::hasTable('portfolios');
        $hasPartners = Schema::hasTable('brand_partners');
        $hasClients = Schema::hasTable('clients');
        $hasHeroSlides = Schema::hasTable('hero_slides');

        $stats = [
            'total_products' => $hasProducts ? Product::count() : 0,
            'featured_products' => $hasProducts ? Product::query()->featured()->count() : 0,
            'in_stock_products' => $hasProducts ? Product::query()->where('availability_status', 'in_stock')->count() : 0,
            'total_categories' => $hasCategories ? Category::count() : 0,
            'total_inquiries' => $hasInquiries ? Inquiry::count() : 0,
            'new_inquiries' => $hasInquiries ? Inquiry::query()->where('status', 'new')->count() : 0,
            'in_progress_inquiries' => $hasInquiries ? Inquiry::query()->where('status', 'in_progress')->count() : 0,
            'total_portfolios' => $hasPortfolios ? Portfolio::count() : 0,
            'total_partners' => $hasPartners ? BrandPartner::count() : 0,
            'total_clients' => $hasClients ? Client::count() : 0,
            'total_slides' => $hasHeroSlides ? HeroSlide::count() : 0,
        ];

        $recentInquiries = $hasInquiries
            ? Inquiry::query()->with('product')->recent()->limit(6)->get()
            : collect();

        $recentProducts = $hasProducts
            ? Product::query()->with('category')->orderByDesc('created_at')->limit(6)->get()
            : collect();

        $categoriesSummary = $hasCategories
            ? Category::query()
                ->withCount('products')
                ->orderByDesc('products_count')
                ->limit(6)
                ->get()
            : collect();

        $systemInfo = [
            'php_version' => PHP_VERSION,
            'laravel_version' => app()->version(),
            'database' => config('database.default'),
            'environment' => app()->environment(),
            'debug_mode' => config('app.debug') ? 'Enabled' : 'Disabled',
        ];

        return view('admin.dashboard', compact(
            'stats',
            'recentInquiries',
            'recentProducts',
            'categoriesSummary',
            'systemInfo'
        ));
    }
}
