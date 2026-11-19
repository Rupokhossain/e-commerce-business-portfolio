<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Inquiry;
use App\Models\SiteSetting;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('*', function ($view): void {
            $request = request();

            if (! $request->attributes->has('_shared_layout_data')) {
                $settings = SiteSetting::allMap();
                $navCategories = Schema::hasTable('categories')
                    ? Category::query()->active()->ordered()->get()
                    : collect();
                $newInquiriesCount = Schema::hasTable('inquiries')
                    ? Inquiry::query()->where('status', 'new')->count()
                    : 0;

                $request->attributes->set('_shared_layout_data', [
                    'siteSettings' => $settings,
                    'navCategories' => $navCategories,
                    'newInquiriesCount' => $newInquiriesCount,
                ]);
            }

            $view->with($request->attributes->get('_shared_layout_data'));
        });
    }
}
