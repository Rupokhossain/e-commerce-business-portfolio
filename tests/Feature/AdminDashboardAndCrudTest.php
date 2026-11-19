<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Inquiry;
use App\Models\Product;
use App\Models\User;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminDashboardAndCrudTest extends TestCase
{
    use RefreshDatabase;

    protected User $adminUser;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(DatabaseSeeder::class);

        $this->adminUser = User::query()->where('email', 'admin@proudrock.com')->firstOrFail();
    }

    public function test_guest_is_redirected_to_admin_login(): void
    {
        $response = $this->get('/admin');
        $response->assertRedirect(route('admin.login'));
    }

    public function test_authenticated_admin_can_view_dashboard_with_dynamic_stats(): void
    {
        $response = $this->actingAs($this->adminUser)->get('/admin');

        $response->assertStatus(200);
        $response->assertSee('Welcome back, ProudRock Admin');
        $response->assertSee('Client Inquiries');
        $response->assertSee('Total Products');
        $response->assertSee('Hardware Categories');
        $response->assertSee('Verified Cases');
        $response->assertSee('Recent Client Inquiries &amp; RFQs', false);
        $response->assertSee('System Environment &amp; Specs', false);
    }

    public function test_admin_can_manage_inquiries_and_update_status(): void
    {
        $inquiry = Inquiry::query()->create([
            'name' => 'Tanvir Ahmed',
            'company_name' => 'Bengal Logistics Ltd.',
            'phone' => '+8801811223344',
            'email' => 'tanvir@bengallogistics.example',
            'subject' => 'Quote for UHF RFID Gates',
            'message' => 'Need 4 RFID gates for Chattogram depot loading bay.',
            'status' => 'new',
        ]);

        $listResponse = $this->actingAs($this->adminUser)->get('/admin/inquiries');
        $listResponse->assertStatus(200);
        $listResponse->assertSee('Tanvir Ahmed');
        $listResponse->assertSee('Bengal Logistics Ltd.');

        $showResponse = $this->actingAs($this->adminUser)->get('/admin/inquiries/' . $inquiry->id);
        $showResponse->assertStatus(200);
        $showResponse->assertSee('Inquiry Details #' . $inquiry->id);
        $showResponse->assertSee('+8801811223344');

        $patchResponse = $this->actingAs($this->adminUser)->patch('/admin/inquiries/' . $inquiry->id . '/status', [
            'status' => 'in_progress',
            'admin_notes' => 'Called client on phone. Agreed to send proposal.',
        ]);

        $patchResponse->assertSessionHas('success');
        $inquiry->refresh();
        $this->assertSame('in_progress', $inquiry->status);
        $this->assertSame('Called client on phone. Agreed to send proposal.', $inquiry->admin_notes);
    }

    public function test_admin_can_create_edit_and_update_products(): void
    {
        $category = Category::query()->firstOrFail();

        $createResponse = $this->actingAs($this->adminUser)->get('/admin/products/create');
        $createResponse->assertStatus(200);
        $createResponse->assertSee('Add New Hardware Product');

        $postResponse = $this->actingAs($this->adminUser)->post('/admin/products', [
            'category_id' => $category->id,
            'name' => 'Zebra TC26 Touch Computer',
            'slug' => 'zebra-tc26-touch-computer',
            'brand' => 'Zebra',
            'model_number' => 'TC26',
            'sku' => 'PR-ZB-TC26',
            'availability_status' => 'in_stock',
            'short_description' => 'Rugged cellular & Wi-Fi mobile terminal for warehouse delivery.',
            'description' => 'Comprehensive technical overview for enterprise rollout.',
            'key_features_text' => "Android 10\n13MP Camera\nIP67 Sealed",
            'specifications_text' => "Display Size: 86 Inch 4K UHD\nPanel Type: IPS\nOperating System: Android 14.0\nWarranty: 3 Years",
            'gallery_urls_text' => "images/products/tc26-angle1.jpg\nimages/products/tc26-angle2.jpg",
            'is_featured' => '1',
            'is_active' => '1',
            'sort_order' => 10,
        ]);

        $postResponse->assertRedirect(route('admin.products.index'));
        $postResponse->assertSessionHas('success');

        $product = Product::query()->where('slug', 'zebra-tc26-touch-computer')->first();
        $this->assertNotNull($product);
        $this->assertSame('Zebra TC26 Touch Computer', $product->name);
        $this->assertTrue($product->is_featured);
        $this->assertCount(3, $product->key_features);
        $this->assertCount(4, $product->specifications);
        $this->assertSame('Display Size', $product->specifications[0]['label']);
        $this->assertSame('86 Inch 4K UHD', $product->specifications[0]['value']);
        $this->assertCount(2, $product->gallery);

        $editResponse = $this->actingAs($this->adminUser)->get('/admin/products/' . $product->id . '/edit');
        $editResponse->assertStatus(200);
        $editResponse->assertSee('Edit Product: Zebra TC26 Touch Computer');

        $putResponse = $this->actingAs($this->adminUser)->put('/admin/products/' . $product->id, [
            'category_id' => $category->id,
            'name' => 'Zebra TC26 Touch Computer Updated',
            'slug' => 'zebra-tc26-touch-computer',
            'brand' => 'Zebra Technologies',
            'availability_status' => 'in_stock',
            'is_featured' => '1',
            'is_active' => '1',
            'sort_order' => 5,
        ]);

        $putResponse->assertRedirect(route('admin.products.index'));
        $product->refresh();
        $this->assertSame('Zebra TC26 Touch Computer Updated', $product->name);
        $this->assertSame('Zebra Technologies', $product->brand);
    }

    public function test_admin_can_create_product_with_new_category_name_on_the_fly(): void
    {
        $this->assertDatabaseMissing('categories', ['name' => 'POS Peripherals & Scales']);

        $response = $this->actingAs($this->adminUser)->post('/admin/products', [
            'new_category_name' => 'POS Peripherals & Scales',
            'name' => 'Datalogic Magellan 9800i Scanner Scale',
            'availability_status' => 'in_stock',
        ]);

        $response->assertRedirect(route('admin.products.index'));
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('categories', ['name' => 'POS Peripherals & Scales']);
        $newCategory = Category::where('name', 'POS Peripherals & Scales')->firstOrFail();

        $product = Product::where('name', 'Datalogic Magellan 9800i Scanner Scale')->firstOrFail();
        $this->assertSame($newCategory->id, $product->category_id);
    }

    public function test_admin_can_update_site_settings(): void
    {
        $getResponse = $this->actingAs($this->adminUser)->get('/admin/settings');
        $getResponse->assertStatus(200);
        $getResponse->assertSee('Site Settings');
        $getResponse->assertSee('Company Identity');

        $postResponse = $this->actingAs($this->adminUser)->post('/admin/settings', [
            'contact_phone' => '+880 2-9999888',
            'whatsapp_number' => '8801700000000',
            'company_name' => 'ProudRock Ltd. Automation',
        ]);

        $postResponse->assertSessionHas('success');

        $this->assertSame('+880 2-9999888', \App\Models\SiteSetting::getValue('contact_phone'));
        $this->assertSame('8801700000000', \App\Models\SiteSetting::getValue('whatsapp_number'));
        $this->assertSame('ProudRock Ltd. Automation', \App\Models\SiteSetting::getValue('company_name'));
    }

    public function test_admin_can_create_update_and_delete_hero_slide(): void
    {
        // 1. Create slide
        $createResponse = $this->actingAs($this->adminUser)->post('/admin/hero-slides', [
            'title' => 'Advanced Factory Automation 2026',
            'eyebrow' => 'Turnkey Robotics & Vision',
            'subtitle' => 'High speed inspection systems for modern apparel manufacturing.',
            'cta_text' => 'Explore Solutions',
            'link_url' => '/products',
            'sort_order' => 10,
            'is_active' => '1',
        ]);

        $createResponse->assertRedirect(route('admin.hero-slides.index'));
        $createResponse->assertSessionHas('success');

        $slide = \App\Models\HeroSlide::where('title', 'Advanced Factory Automation 2026')->firstOrFail();
        $this->assertSame('Turnkey Robotics & Vision', $slide->eyebrow);

        // 2. Update slide
        $updateResponse = $this->actingAs($this->adminUser)->put('/admin/hero-slides/' . $slide->id, [
            'title' => 'Updated Automation Title',
            'eyebrow' => 'Turnkey Robotics & Vision',
            'sort_order' => 15,
            'is_active' => '1',
        ]);

        $updateResponse->assertRedirect(route('admin.hero-slides.index'));
        $updateResponse->assertSessionHas('success');

        $slide->refresh();
        $this->assertSame('Updated Automation Title', $slide->title);

        // 3. Delete slide
        $deleteResponse = $this->actingAs($this->adminUser)->delete('/admin/hero-slides/' . $slide->id);
        $deleteResponse->assertRedirect(route('admin.hero-slides.index'));
        $deleteResponse->assertSessionHas('success');

        $this->assertModelMissing($slide);
    }

    public function test_admin_can_manage_dynamic_social_links(): void
    {
        $response = $this->actingAs($this->adminUser)->post('/admin/settings', [
            'social_links' => [
                ['platform' => 'facebook', 'label' => 'Proud Rock Official FB', 'url' => 'https://facebook.com/proudrockenterprise'],
                ['platform' => 'linkedin', 'label' => 'Proud Rock Corporate LinkedIn', 'url' => 'https://linkedin.com/company/proudrock-official'],
                ['platform' => 'youtube', 'label' => '', 'url' => ''], // empty should be filtered out
            ],
        ]);

        $response->assertSessionHas('success');

        $storedJson = \App\Models\SiteSetting::getValue('social_links');
        $this->assertNotNull($storedJson);
        $decoded = json_decode($storedJson, true);
        $this->assertCount(2, $decoded);
        $this->assertSame('https://facebook.com/proudrockenterprise', $decoded[0]['url']);
        $this->assertSame('https://linkedin.com/company/proudrock-official', $decoded[1]['url']);

        // Test footer displays the updated links
        $homeResponse = $this->get('/');
        $homeResponse->assertStatus(200);
        $homeResponse->assertSee('https://facebook.com/proudrockenterprise');
        $homeResponse->assertSee('https://linkedin.com/company/proudrock-official');
    }

    public function test_admin_can_upload_and_remove_site_logo(): void
    {
        \Illuminate\Support\Facades\Storage::fake('public');

        $fakeFile = \Illuminate\Http\UploadedFile::fake()->image('company_logo.png', 300, 100);

        $response = $this->actingAs($this->adminUser)->post('/admin/settings', [
            'site_logo_file' => $fakeFile,
            'company_name' => 'Proud Rock Enterprise Ltd.',
        ]);

        $response->assertSessionHas('success');

        $logoPath = \App\Models\SiteSetting::getValue('site_logo');
        $this->assertNotEmpty($logoPath);
        $this->assertStringContainsString('storage/branding/logo_', $logoPath);

        // Verify logo renders on homepage
        $homeResponse = $this->get('/');
        $homeResponse->assertStatus(200);
        $homeResponse->assertSee($logoPath);

        // Now test removing the logo
        $removeResponse = $this->actingAs($this->adminUser)->post('/admin/settings', [
            'remove_site_logo' => '1',
        ]);
        $removeResponse->assertSessionHas('success');
        $this->assertEmpty(\App\Models\SiteSetting::getValue('site_logo'));
    }

    public function test_topbar_right_text_and_gallery_settings_are_controllable(): void
    {
        $response = $this->actingAs($this->adminUser)->post('/admin/settings', [
            'header_topbar_right_text' => 'Direct Hotline (9 AM – 9 PM) · Dhaka Engineering Hub',
            'gallery_badge' => 'Exclusive Factory Deployments',
            'gallery_title' => 'Proud Rock Enterprise Automation Gallery',
            'gallery_subtitle' => 'Live photos of 50+ industrial automation and barcode systems running across Bangladesh.',
        ]);

        $response->assertSessionHas('success');

        // Check Topbar displays the custom right-side text (fixes empty space)
        $homeResponse = $this->get('/');
        $homeResponse->assertStatus(200);
        $homeResponse->assertSee('Direct Hotline (9 AM – 9 PM) · Dhaka Engineering Hub');

        // Check Field Deployments Gallery displays the new headline & badge
        $galleryResponse = $this->get('/gallery');
        $galleryResponse->assertStatus(200);
        $galleryResponse->assertSee('Exclusive Factory Deployments');
        $galleryResponse->assertSee('Proud Rock Enterprise Automation Gallery');
        $galleryResponse->assertSee('Live photos of 50+ industrial automation');
    }

    public function test_delete_preserves_page_query_parameter_and_prevents_empty_pages(): void
    {
        $category = Category::query()->firstOrFail();

        // Create enough products so we have at least 2 pages (pagination is 15 per page)
        $initialCount = Product::count();
        $targetCount = 17;
        for ($i = $initialCount; $i < $targetCount; $i++) {
            Product::create([
                'category_id' => $category->id,
                'name' => "Batch Product Test {$i}",
                'slug' => "batch-product-test-{$i}",
                'availability_status' => 'in_stock',
                'is_active' => true,
            ]);
        }

        // Test 1: Deleting with redirect_to returns to the exact URL passed in redirect_to (e.g. page 2)
        $productToDelete = Product::query()->latest('id')->firstOrFail();
        $page2Url = route('admin.products.index', ['page' => 2]);

        $deleteResponse = $this->actingAs($this->adminUser)->delete(
            route('admin.products.destroy', $productToDelete),
            ['redirect_to' => $page2Url]
        );

        $deleteResponse->assertRedirect($page2Url);
        $deleteResponse->assertSessionHas('success');

        // Test 2: If page 2 has no more items, visiting page 2 automatically redirects to page 1
        // First delete all remaining items on page 2 so only 15 items remain
        while (Product::count() > 15) {
            Product::query()->latest('id')->first()->delete();
        }

        $page2VisitResponse = $this->actingAs($this->adminUser)->get(route('admin.products.index', ['page' => 2]));
        // Since page 2 is now empty, index() must redirect to page 1
        $page2VisitResponse->assertRedirect(route('admin.products.index', ['page' => 1]));
    }
}
