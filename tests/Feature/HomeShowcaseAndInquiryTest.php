<?php

namespace Tests\Feature;

use App\Models\Inquiry;
use App\Models\Product;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HomeShowcaseAndInquiryTest extends TestCase
{
    use RefreshDatabase;

    public function test_home_renders_brands_industries_bento_and_cta_banner_without_portfolio(): void
    {
        $this->seed(DatabaseSeeder::class);

        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('data-home-brands', false);
        $response->assertSee('data-home-industries', false);
        $response->assertDontSee('data-home-portfolio', false);
        $response->assertDontSee('Recent Enterprise Deployments');
        $response->assertSee('data-home-cta', false);

        $response->assertSee('Authorized OEM Partners');
        $response->assertSee('brand-marquee-track', false);
        $response->assertSee('images/1741167467.jpg', false);
        $response->assertSee('images/1707813138.png', false);
        $response->assertSee('Serving Diverse Industries');
        $response->assertSee('Bank &amp; Corporate', false);
        $response->assertSee('Garments &amp; RMG', false);
        $response->assertSee('Retail &amp; POS', false);
        $response->assertSee('Warehouse &amp; Logistics', false);
        $response->assertSee('Hospital &amp; Healthcare', false);
        $response->assertSee('images/industries/retail.jpg', false);
        $response->assertSee('WhatsApp Engineering Desk');
    }

    public function test_portfolio_page_lists_and_filters_deployments_by_industry(): void
    {
        $this->seed(DatabaseSeeder::class);

        $allResponse = $this->get('/portfolio');
        $allResponse->assertStatus(200);
        $allResponse->assertSee('data-portfolio-about', false);
        $allResponse->assertSee('data-portfolio-why', false);
        $allResponse->assertSee('Welcome to ProudRock Ltd.');
        $allResponse->assertSee('Why Choose Us');
        $allResponse->assertSee('images/portfolio-about.jpg', false);
        $allResponse->assertSee('Automated UHF RFID Carton Verification Gates across 6 Loading Bays');
        $allResponse->assertSee('24/7 Industrial Hangtag &amp; Care-Label Printing Line Modernization', false);

        $filteredResponse = $this->get('/portfolio?industry=Retail+%26+POS');
        $filteredResponse->assertStatus(200);
        $filteredResponse->assertSee('Nationwide 45-Outlet Dual-Screen Smart POS &amp; Thermal Printing Network', false);
        $filteredResponse->assertDontSee('Automated UHF RFID Carton Verification Gates across 6 Loading Bays');
    }

    public function test_contact_page_prefills_product_and_persists_validated_inquiry(): void
    {
        $this->seed(DatabaseSeeder::class);

        $product = Product::query()->where('slug', 'tsc-tl240-desktop-label-printer')->firstOrFail();

        $getResponse = $this->get('/contact?product=' . $product->slug);
        $getResponse->assertStatus(200);
        $getResponse->assertSee('Requesting quote for:');
        $getResponse->assertSee($product->name);

        $invalidResponse = $this->post('/contact', [
            'name' => '',
            'phone' => '',
            'message' => 'short',
        ]);
        $invalidResponse->assertSessionHasErrors(['name', 'phone', 'message']);

        $postResponse = $this->post('/contact', [
            'product_id' => $product->id,
            'name' => 'Kamrul Hasan',
            'company_name' => 'Desh Knitwear Ltd.',
            'phone' => '+8801711223344',
            'email' => 'kamrul@deshknit.example',
            'subject' => 'Quote for 15 TSC TL240 Printers',
            'message' => 'Need corporate unit price and Dhaka installation schedule for 15 desktop label printers.',
        ]);

        $postResponse->assertRedirect(route('contact.index'));
        $postResponse->assertSessionHas('inquiry_submitted');

        $inquiry = Inquiry::query()->first();
        $this->assertNotNull($inquiry);
        $this->assertSame($product->id, $inquiry->product_id);
        $this->assertSame('Kamrul Hasan', $inquiry->name);
        $this->assertSame('new', $inquiry->status);
    }
}