<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Inquiry;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class InquiryController extends Controller
{
    public function index(): View
    {
        $inquiries = Inquiry::latest()->paginate(10);

        return view('admin.inquiry', compact('inquiries'));
    }

    public function updateStatus(Request $request, Inquiry $inquiry): RedirectResponse
    {
        $request->validate([
            'status' => ['required', 'in:pending,active,inactive'],
        ]);

        $inquiry->update(['status' => $request->status]);

        return back()->with('status', 'Inquiry status update ho gaya.');
    }

    public function destroy(Inquiry $inquiry): RedirectResponse
    {
        $inquiry->delete();

        return back()->with('status', 'Inquiry delete kar diya gaya.');
    }
}
