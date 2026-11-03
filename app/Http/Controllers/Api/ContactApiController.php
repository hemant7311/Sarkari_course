<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Inquiry;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ContactApiController extends Controller
{
    /**
     * POST /api/contact
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:150'],
            'mobile' => ['nullable', 'string', 'max:20'],
            'email' => ['required', 'email', 'max:255'],
            'course' => ['nullable', 'string', 'max:150'],
            'message' => ['required', 'string', 'max:2000'],
        ]);

        Inquiry::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Aapka message bhej diya gaya hai. Hamari team jald aapse contact karegi.',
        ], 201);
    }
}
