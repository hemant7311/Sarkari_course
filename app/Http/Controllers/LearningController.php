<?php

namespace App\Http\Controllers;

use App\Models\Chapter;
use App\Services\LearningService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class LearningController extends Controller
{
    public function complete(Request $request, Chapter $chapter, LearningService $learning): RedirectResponse
    {
        $learning->completeChapter($request->user(), $chapter);

        return back()->with('status', 'Lesson marked complete.');
    }
}
