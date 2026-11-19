<?php

namespace App\Http\Controllers;

use App\Models\Inquiry;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ContactController extends Controller
{
    public function index(Request $request): View
    {
        $productSlug = $request->string('product')->trim()->toString();
        $selectedProduct = $productSlug !== ''
            ? Product::query()->active()->where('slug', $productSlug)->first()
            : null;

        $products = Product::query()
            ->active()
            ->ordered()
            ->with('category:id,name')
            ->get(['id', 'name', 'model_number', 'slug', 'category_id', 'brand']);

        $groupedProducts = $products->groupBy(function ($product) {
            return $product->category->name ?? 'General Solutions';
        });

        return view('contact.index', [
            'selectedProduct' => $selectedProduct,
            'products' => $products,
            'groupedProducts' => $groupedProducts,
            'prefillSubject' => $selectedProduct
                ? "Quotation Inquiry: {$selectedProduct->name}"
                : $request->string('subject')->trim()->toString(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'product_id' => ['nullable', 'integer', 'exists:products,id'],
            'name' => ['required', 'string', 'max:120'],
            'company_name' => ['nullable', 'string', 'max:150'],
            'phone' => ['required', 'string', 'max:40'],
            'email' => ['nullable', 'email', 'max:150'],
            'subject' => ['nullable', 'string', 'max:180'],
            'message' => ['required', 'string', 'min:10', 'max:3000'],
        ]);

        Inquiry::query()->create([
            'product_id' => $validated['product_id'] ?? null,
            'name' => $validated['name'],
            'company_name' => $validated['company_name'] ?? null,
            'phone' => $validated['phone'],
            'email' => $validated['email'] ?? null,
            'subject' => $validated['subject'] ?? null,
            'message' => $validated['message'],
            'status' => 'new',
        ]);

        return redirect()
            ->route('contact.index')
            ->with('inquiry_submitted', 'Thank you! Your hardware & technical quote request has been received. Our corporate sales team will respond shortly.');
    }
}