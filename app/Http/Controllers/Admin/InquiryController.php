<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Inquiry;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class InquiryController extends Controller
{
    public function index(Request $request): View|RedirectResponse
    {
        $status = $request->query('status');
        $search = $request->query('search');

        $query = Inquiry::query()->with('product')->recent();

        if ($status && in_array($status, ['new', 'in_progress', 'closed'])) {
            $query->where('status', $status);
        }

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('company_name', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('subject', 'like', "%{$search}%");
            });
        }

        $inquiries = $query->paginate(12)->withQueryString();

        if ($inquiries->isEmpty() && $inquiries->currentPage() > 1) {
            return redirect()->to(
                $request->fullUrlWithQuery(['page' => $inquiries->lastPage() ?: 1])
            );
        }

        $counts = [
            'all' => Inquiry::count(),
            'new' => Inquiry::where('status', 'new')->count(),
            'in_progress' => Inquiry::where('status', 'in_progress')->count(),
            'closed' => Inquiry::where('status', 'closed')->count(),
        ];

        return view('admin.inquiries.index', compact('inquiries', 'status', 'search', 'counts'));
    }

    public function show(Inquiry $inquiry): View
    {
        $inquiry->load('product.category');

        return view('admin.inquiries.show', compact('inquiry'));
    }

    public function updateStatus(Request $request, Inquiry $inquiry): RedirectResponse
    {
        $validated = $request->validate([
            'status' => ['required', 'in:new,in_progress,closed'],
            'admin_notes' => ['nullable', 'string', 'max:2000'],
        ]);

        $inquiry->update($validated);

        return back()->with('success', "Inquiry status updated to '{$inquiry->status}'.");
    }

    public function destroy(Request $request, Inquiry $inquiry): RedirectResponse
    {
        $inquiry->delete();

        $redirectTo = $request->input('redirect_to') ?: route('admin.inquiries.index');

        return redirect()->to($redirectTo)
            ->with('success', 'Inquiry deleted successfully.');
    }
}
