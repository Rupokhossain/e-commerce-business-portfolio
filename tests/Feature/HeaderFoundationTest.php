<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\HeroSlide;
use App\Models\SiteSetting;
use App\Models\User;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HeaderFoundationTest extends TestCase
{
    use RefreshDatabase;

    public function test_all_primary_navigation_routes_render_with_dynamic_header_and_login_button(): void
    {
        $this->seed(DatabaseSeeder::class);

        foreach (['/', '/products', '/portfolio', '/contact'] as $uri) {
            $response = $this->get($uri);

            $response->assertStatus(200);
            $response->assertSee('proud', false);
            $response->assertSee('rock ltd.', false);
            $response->assertSee('info@proudrock.com');
            $response->assertSee('Barcode &amp; Auto-ID', false);
            $response->assertSee('Login');
            $response->assertSee(route('admin.login'), false);
            $response->assertSee('Request Quote');
            $response->assertDontSee('Add to Cart');
        }
    }

    public function test_admin_login_flow_redirects_to_dashboard_and_updates_header_button(): void
    {
        $this->seed(DatabaseSeeder::class);

        $this->get('/admin')->assertRedirect(route('admin.login'));
        $this->get(route('admin.login'))->assertStatus(200)->assertSee('Admin Sign In');

        $response = $this->post(route('admin.login.submit'), [
            'email' => 'admin@proudrock.com',
            'password' => 'password',
        ]);

        $response->assertRedirect(route('admin.dashboard'));
        $this->assertAuthenticatedAs(User::where('email', 'admin@proudrock.com')->first());

        $this->get('/admin')->assertStatus(200)->assertSee('Admin Panel');
        $this->get('/')->assertStatus(200)->assertSee('Dashboard')->assertSee(route('admin.dashboard'), false);
    }

    public function test_home_renders_all_active_hero_banner_slides_and_hides_inactive_ones(): void
    {
        $this->seed(DatabaseSeeder::class);

        HeroSlide::query()->create([
            'title' => 'Hidden Inactive Banner',
            'image_path' => 'images/banner-hidden.png',
            'sort_order' => 99,
            'is_active' => false,
        ]);

        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('data-hero-slider', false);
        $response->assertSee('aspect-[12/5]', false);
        $response->assertSee('images/banner-1.png', false);
        $response->assertSee('images/banner-2.png', false);
        $response->assertSee('images/banner-3.png', false);
        $response->assertSee('images/banner-4-fit.png', false);
        $response->assertDontSee('images/banner-hidden.png', false);
        $response->assertDontSee('<a href="/products" class="block', false);
    }

    public function test_home_renders_dynamic_trust_strip_and_active_solution_categories(): void
    {
        $this->seed(DatabaseSeeder::class);

        Category::query()->create([
            'name' => 'Inactive Hidden Category',
            'slug' => 'inactive-hidden-category',
            'icon' => 'layers',
            'short_description' => 'Should stay hidden from home grid.',
            'sort_order' => 99,
            'is_active' => false,
        ]);

        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('data-trust-strip', false);
        $response->assertSee('15+ Years');
        $response->assertSee('Industrial Automation Experience');
        $response->assertSee('500+');
        $response->assertSee('data-home-categories', false);
        $response->assertSee('data-category-marquee', false);
        $response->assertSee('Solution Categories');
        $response->assertSee('images/categories/barcode-auto-id.jpg', false);
        $response->assertSee('images/categories/rfid-systems.jpg', false);
        $response->assertSee(route('products.index', ['category' => 'barcode-auto-id']), false);
        $response->assertSee(route('products.index', ['category' => 'rfid-systems']), false);
        $response->assertDontSee('Inactive Hidden Category');

        SiteSetting::setMany([
            'trust_strip_enabled' => '0',
            'home_categories_enabled' => '0',
        ], 'home_sections');

        $toggledOff = $this->get('/');
        $toggledOff->assertStatus(200);
        $toggledOff->assertDontSee('data-trust-strip', false);
        $toggledOff->assertDontSee('data-home-categories', false);
    }
}
