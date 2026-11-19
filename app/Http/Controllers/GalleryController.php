<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use Illuminate\Http\Request;
use Illuminate\View\View;

class GalleryController extends Controller
{
    public function index(Request $request): View
    {
        $activeType = $request->string('type')->trim()->toString();

        $types = Portfolio::query()
            ->active()
            ->whereNotNull('industry')
            ->where('industry', '!=', '')
            ->distinct()
            ->orderBy('industry')
            ->pluck('industry');

        $query = Portfolio::query()
            ->active()
            ->whereNotNull('image')
            ->where('image', '!=', '')
            ->ordered();

        if ($activeType !== '') {
            $query->where('industry', $activeType);
        }

        $items = $query->paginate(10)->withQueryString();

        return view('gallery.index', [
            'items' => $items,
            'types' => $types,
            'activeType' => $activeType,
        ]);
    }
}
