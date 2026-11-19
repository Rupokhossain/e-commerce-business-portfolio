<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(Request $request): View
    {
        $categorySlug = $request->string('category')->trim()->toString();
        $brand = $request->string('brand')->trim()->toString();
        $searchQuery = $request->string('q')->trim()->toString();
        $sort = $request->string('sort', 'featured')->toString();

        $categories = Category::query()->active()->ordered()->get();
        $activeCategory = $categorySlug !== ''
            ? $categories->firstWhere('slug', $categorySlug)
            : null;

        $brands = Product::query()
            ->active()
            ->whereNotNull('brand')
            ->where('brand', '!=', '')
            ->distinct()
            ->orderBy('brand')
            ->pluck('brand');

        $productsQuery = Product::query()
            ->with('category')
            ->active();

        if ($activeCategory) {
            $productsQuery->where('category_id', $activeCategory->id);
        }

        if ($brand !== '') {
            $productsQuery->where('brand', $brand);
        }

        if ($searchQuery !== '') {
            $term = '%' . $searchQuery . '%';
            $productsQuery->where(function ($query) use ($term): void {
                $query->where('name', 'like', $term)
                    ->orWhere('brand', 'like', $term)
                    ->orWhere('model_number', 'like', $term)
                    ->orWhere('sku', 'like', $term)
                    ->orWhere('short_description', 'like', $term);
            });
        }

        match ($sort) {
            'name_asc' => $productsQuery->orderBy('name'),
            'latest' => $productsQuery->orderByDesc('id'),
            default => $productsQuery->ordered(),
        };

        $products = $productsQuery->paginate(24)->withQueryString();

        return view('products.index', [
            'products' => $products,
            'categories' => $categories,
            'brands' => $brands,
            'activeCategory' => $activeCategory,
            'activeCategorySlug' => $categorySlug,
            'activeBrand' => $brand,
            'searchQuery' => $searchQuery,
            'sort' => $sort,
        ]);
    }

    public function show(string $slug): View
    {
        $product = Product::query()
            ->with('category')
            ->active()
            ->where('slug', $slug)
            ->firstOrFail();

        $relatedProducts = Product::query()
            ->with('category')
            ->active()
            ->where('category_id', $product->category_id)
            ->whereKeyNot($product->id)
            ->ordered()
            ->limit(4)
            ->get();

        return view('products.show', [
            'product' => $product,
            'relatedProducts' => $relatedProducts,
        ]);
    }
}
