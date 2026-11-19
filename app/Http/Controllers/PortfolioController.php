<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PortfolioController extends Controller
{
    public function index(Request $request): View
    {
        $activeIndustry = $request->string('industry')->trim()->toString();

        $industries = Portfolio::query()
            ->active()
            ->whereNotNull('industry')
            ->where('industry', '!=', '')
            ->distinct()
            ->orderBy('industry')
            ->pluck('industry');

        $portfoliosQuery = Portfolio::query()
            ->active()
            ->ordered();

        if ($activeIndustry !== '') {
            $portfoliosQuery->where('industry', $activeIndustry);
        }

        $portfolios = $portfoliosQuery->paginate(9)->withQueryString();

        return view('portfolio.index', [
            'portfolios' => $portfolios,
            'industries' => $industries,
            'activeIndustry' => $activeIndustry,
        ]);
    }
}