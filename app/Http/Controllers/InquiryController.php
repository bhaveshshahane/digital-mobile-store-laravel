<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inquiry;

class InquiryController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        Inquiry::create($validated);

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Thank you for your message! We will get back to you shortly.',
            ]);
        }

        return back()->with('success', 'Thank you for your message! We will get back to you shortly.');
    }
}
