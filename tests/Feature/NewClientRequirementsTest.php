<?php

namespace Tests\Feature;

use App\Models\BrandPartner;
use App\Models\Category;
use App\Models\Portfolio;
use App\Models\Product;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class NewClientRequirementsTest extends TestCase
{
    use RefreshDatabase;

    public function test_company_profile_page_renders_principles_and_clients(): void
    {
        $this->seed(DatabaseSeeder::class);

        $response = $this->get('/company-profile');

        $response->assertStatus(200);
        $response->assertSee('Company Profile');
        $response->assertSee('Global Hardware Principles &amp; Enterprise Deployments', false);
        $response->assertSee('Track 1 • Global Hardware Principles We Distribute &amp; Support', false);
        $response->assertSee('Track 2 • Principle Clients &amp; Factory Implementations in Bangladesh', false);
        $response->assertSee('brand-marquee-track');
        $response->assertSee('client-marquee-track');
        $response->assertSee('Apex Export Knitwear Ltd.');
        $response->assertSee('Square Pharmaceuticals PLC');
        $response->assertSee('GreenBasket Retail Holdings');
        $response->assertSee('15+ Years');
        $response->assertSee('24/7 Active');
    }

    public function test_admin_can_view_and_manage_principle_clients(): void
    {
        $this->seed(DatabaseSeeder::class);

        $user = \App\Models\User::first();

        // 1. View Index
        $response = $this->actingAs($user)->get('/admin/clients');
        $response->assertStatus(200);
        $response->assertSee('Principle Clients');
        $response->assertSee('Apex Export Knitwear Ltd.');

        // 2. View Create Form
        $createResponse = $this->actingAs($user)->get('/admin/clients/create');
        $createResponse->assertStatus(200);
        $createResponse->assertSee('Add Principle Client');

        // 3. Store Client
        $storeResponse = $this->actingAs($user)->post('/admin/clients', [
            'name' => 'Walton Hi-Tech Industries PLC',
            'sector' => 'Consumer Electronics & Appliances',
            'location' => 'Chandra, Gazipur',
            'solution_provided' => 'Manufacturing Line Barcode Tracking & Mobile Terminals',
            'badge' => 'Hi-Tech Manufacturing',
            'is_active' => '1',
            'sort_order' => 11,
        ]);

        $storeResponse->assertRedirect('/admin/clients');
        $this->assertDatabaseHas('clients', [
            'name' => 'Walton Hi-Tech Industries PLC',
            'slug' => 'walton-hi-tech-industries-plc',
        ]);

        $client = \App\Models\Client::where('slug', 'walton-hi-tech-industries-plc')->firstOrFail();

        // 4. Update Client
        $updateResponse = $this->actingAs($user)->put('/admin/clients/' . $client->id, [
            'name' => 'Walton Hi-Tech Industries PLC Updated',
            'slug' => 'walton-hi-tech-industries-plc',
            'sector' => 'Hi-Tech Electronics',
            'is_active' => '1',
            'sort_order' => 12,
        ]);

        $updateResponse->assertRedirect('/admin/clients');
        $this->assertDatabaseHas('clients', [
            'id' => $client->id,
            'name' => 'Walton Hi-Tech Industries PLC Updated',
        ]);

        // 5. Delete Client
        $deleteResponse = $this->actingAs($user)->delete('/admin/clients/' . $client->id);
        $deleteResponse->assertRedirect('/admin/clients');
        $this->assertDatabaseMissing('clients', [
            'id' => $client->id,
        ]);
    }

    public function test_gallery_page_renders_split_row_deployments_with_details_and_location(): void
    {
        $this->seed(DatabaseSeeder::class);

        $response = $this->get('/gallery');

        $response->assertStatus(200);
        $response->assertSee('Field Deployments &amp; Solutions Gallery', false);
        $response->assertSee('Implementation Type:', false);
        $response->assertSee('Project Overview:', false);
        $response->assertSee('Hardware &amp; Equipment:', false);
        $response->assertSee('Measurable Outcome:', false);
        $response->assertSee('data-lightbox-src', false);
        $response->assertSee('Enlarge Photo');
    }

    public function test_contact_page_displays_24_7_support_and_9_to_6_hotline(): void
    {
        $this->seed(DatabaseSeeder::class);

        $response = $this->get('/contact');

        $response->assertStatus(200);
        $response->assertSee('24/7 Technical Support Helpline');
        $response->assertSee('Active 24 Hours');
        $response->assertSee('Corporate Office &amp; Direct Contact', false);
        $response->assertSee('General Project / Multiple Hardware');
    }

    public function test_product_detail_page_includes_social_media_share_hub(): void
    {
        $this->seed(DatabaseSeeder::class);

        $product = Product::query()->firstOrFail();

        $response = $this->get('/products/' . $product->slug);

        $response->assertStatus(200);
        $response->assertSee('Share Product');
        $response->assertSee('WhatsApp');
        $response->assertSee('LinkedIn');
        $response->assertSee('Facebook');
        $response->assertSee('Copy Link');
        $response->assertSee('copy-product-link-btn');
        $response->assertSee('og:image', false);
        $response->assertSee('og:title', false);
    }

    public function test_navigation_header_and_footer_contain_new_page_links(): void
    {
        $this->seed(DatabaseSeeder::class);

        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee(route('company.profile'), false);
        $response->assertSee(route('gallery.index'), false);
        $response->assertSee('Company Profile');
        $response->assertSee('Gallery');
    }
}
