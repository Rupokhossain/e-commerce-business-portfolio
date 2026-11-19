<?php

namespace App\Http\Controllers;

use App\Models\BrandPartner;
use App\Models\Client;
use App\Models\Portfolio;
use Illuminate\Support\Facades\Schema;
use Illuminate\View\View;

class CompanyProfileController extends Controller
{
    public function index(): View
    {
        $brandPartners = Schema::hasTable('brand_partners')
            ? BrandPartner::query()->active()->ordered()->get()
            : collect();

        $principleClients = Schema::hasTable('clients')
            ? Client::query()->active()->ordered()->get()
            : collect();

        $deployments = Schema::hasTable('portfolios')
            ? Portfolio::query()->active()->ordered()->limit(6)->get()
            : collect();

        return view('company.profile', [
            'brandPartners' => $brandPartners,
            'principleClients' => $principleClients,
            'deployments' => $deployments,
        ]);
    }
}
