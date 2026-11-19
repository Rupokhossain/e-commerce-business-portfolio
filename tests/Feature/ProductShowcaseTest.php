<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Product;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductShowcaseTest extends TestCase
{
    use RefreshDatabase;

    public function test_home_renders_featured_products_and_view_more_without_cart_or_order(): void
    {
        $this->seed(DatabaseSeeder::class);

        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('data-home-products', false);
        $response->assertSee('TSC TL240 Desktop Label Printer');
        $response->assertSee('Zebra ZT411 Industrial Barcode Printer');
        $response->assertSee('View More Products');
        $response->assertSee(route('products.index'), false);
        $response->assertDontSee('Epson TM-T88VII High-Speed POS Receipt Printer');
        $response->assertDontSee('Add to cart');
        $response->assertDontSee('Add to Cart');
        $response->assertDontSee('Place Order');
    }

    public function test_products_catalog_supports_category_brand_and_search_filters(): void
    {
        $this->seed(DatabaseSeeder::class);

        $category = Category::query()->where('slug', 'barcode-auto-id')->firstOrFail();
        Product::query()->create([
            'category_id' => $category->id,
            'name' => 'Inactive Test Scanner',
            'slug' => 'inactive-test-scanner',
            'brand' => 'TestBrand',
            'is_active' => false,
        ]);

        // Full catalog includes both featured & non-featured active items
        $allResponse = $this->get('/products');
        $allResponse->assertStatus(200);
        $allResponse->assertSee('TSC TL240 Desktop Label Printer');
        $allResponse->assertSee('Epson TM-T88VII High-Speed POS Receipt Printer');
        $allResponse->assertSee('Enterprise Hardware AMC &amp; Printhead Care SLA', false);
        $allResponse->assertDontSee('Inactive Test Scanner');

        // Filter by category
        $catResponse = $this->get('/products?category=rfid-systems');
        $catResponse->assertStatus(200);
        $catResponse->assertSee('Impinj R700 Enterprise Fixed UHF RFID Reader');
        $catResponse->assertDontSee('TSC TL240 Desktop Label Printer');

        // Filter by search query
        $searchResponse = $this->get('/products?q=TL240');
        $searchResponse->assertStatus(200);
        $searchResponse->assertSee('TSC TL240 Desktop Label Printer');
        $searchResponse->assertDontSee('Sunmi T2s Dual-Screen Smart POS Terminal');
    }

    public function test_product_detail_page_shows_specs_whatsapp_and_phone_inquiry_without_cart(): void
    {
        $this->seed(DatabaseSeeder::class);

        $response = $this->get('/products/tsc-tl240-desktop-label-printer');

        $response->assertStatus(200);
        $response->assertSee('TSC TL240 Desktop Label Printer');
        $response->assertSee('TL240');
        $response->assertSee('PR-TSC-TL240');
        $response->assertSee('In Stock');
        $response->assertSee('Key Features');
        $response->assertSee('DPI: 8 dots/mm (203 dpi)');
        $response->assertSee('Specifications');
        $response->assertSee('Thermal Transfer &amp; Direct Thermal', false);
        $whatsappNumber = \App\Models\SiteSetting::getValue('whatsapp_number', '8801712806237');
        $phone = \App\Models\SiteSetting::getValue('contact_hotline_business', '+880 1712-806237');
        $phoneDigits = preg_replace('/[^0-9+]/', '', $phone);

        $response->assertSee('Inquire on WhatsApp');
        $response->assertSee("https://wa.me/{$whatsappNumber}?text=", false);
        $response->assertSee("tel:{$phoneDigits}", false);
        $response->assertSee('Request Official Quotation');
        $response->assertSee('Related Products');
        $response->assertDontSee('Overview &amp; Enterprise Applications', false);
        $response->assertDontSee('Add to cart');
        $response->assertDontSee('Add to Cart');
    }

    public function test_inactive_product_returns_404(): void
    {
        $this->seed(DatabaseSeeder::class);

        $category = Category::query()->firstOrFail();
        Product::query()->create([
            'category_id' => $category->id,
            'name' => 'Draft Hidden Hardware',
            'slug' => 'draft-hidden-hardware',
            'is_active' => false,
        ]);

        $this->get('/products/draft-hidden-hardware')->assertNotFound();
    }

    public function test_uploaded_storage_image_resolves_correct_url_without_double_storage(): void
    {
        $this->seed(DatabaseSeeder::class);

        $category = Category::query()->firstOrFail();
        $product = Product::query()->create([
            'category_id' => $category->id,
            'name' => 'Uploaded Image Test Hardware',
            'slug' => 'uploaded-image-test-hardware',
            'image' => 'storage/products/test-upload-sample.jpg',
            'is_active' => true,
        ]);

        $this->assertStringNotContainsString('storage/storage', $product->image_url);
        $this->assertStringContainsString('storage/products/test-upload-sample.jpg', $product->image_url);

        $response = $this->get('/products/uploaded-image-test-hardware');
        $response->assertStatus(200);
        $response->assertDontSee('storage/storage');
        $response->assertSee('storage/products/test-upload-sample.jpg', false);
        $response->assertSee('data-lightbox-src', false);
    }

    public function test_interactive_flat_panel_guide_and_products_display_correctly(): void
    {
        $this->seed(DatabaseSeeder::class);

        // Catalog category filter view
        $catResponse = $this->get('/products?category=interactive-flat-panel-displays');
        $catResponse->assertStatus(200);
        $catResponse->assertSee('BenQ RE8604');
        $catResponse->assertSee('Where Interactive Flat Panels Are Used');
        $catResponse->assertSee('Choose Interactive Flat Panel by Room Size');
        $catResponse->assertSee('Interactive Panel vs Projector vs TV');
        $catResponse->assertSee('Corporate Meeting Room');
        $catResponse->assertSee('Small Classroom &amp; Coaching Room', false);
        $catResponse->assertSee('65″', false);
        $catResponse->assertSee('86″', false);

        // Product details page view
        $productResponse = $this->get('/products/benq-re8604-86-inch-4k-uhd-interactive-flat-panel');
        $productResponse->assertStatus(200);
        $productResponse->assertSee('BenQ RE8604');
        $productResponse->assertSee('Where Interactive Flat Panels Are Used');
        $productResponse->assertSee('Choose Interactive Flat Panel by Room Size');
        $productResponse->assertSee('Interactive Panel vs Projector vs TV');
        $productResponse->assertSee('Native Resolution');
        $productResponse->assertSee('4K UHD 3840x2160 pixels');
    }

    public function test_access_control_banner_and_products_display_correctly(): void
    {
        $this->seed(DatabaseSeeder::class);

        // Catalog category filter view
        $catResponse = $this->get('/products?category=access-control-biometrics');
        $catResponse->assertStatus(200);
        $catResponse->assertSee('Reliable Access Control &amp; Biometric Attendance Systems in Bangladesh', false);
        $catResponse->assertSee('ZKTeco');
        $catResponse->assertSee('VIRDI');
        $catResponse->assertSee('Hikvision');
        $catResponse->assertSee('NexaKey');
        $catResponse->assertSee('Complete 280KG Electromagnetic Lock Access Control Solution Package');
        $catResponse->assertSee('ZKTeco SpeedFace-V5L');

        // Product details page view for EM Lock Package
        $productResponse = $this->get('/products/complete-280kg-em-lock-access-control-package');
        $productResponse->assertStatus(200);
        $productResponse->assertSee('280 KG (600 lbs) static holding force');
        $productResponse->assertSee('Reliable Access Control &amp; Biometric Attendance Systems in Bangladesh', false);
        $productResponse->assertSee('WhatsApp Inquiry');
    }
}
