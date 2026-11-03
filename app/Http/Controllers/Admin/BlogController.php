<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class BlogController extends Controller
{
    public function index(): View
    {
        $blogs = Blog::latest()->paginate(10);

        return view('admin.blogs', compact('blogs'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validateBlog($request);
        $validated['author_id'] = $request->user()->id;
        $validated['slug'] = Str::slug($validated['title']).'-'.Str::random(5);

        if ($request->hasFile('thumbnail')) {
            $validated['thumbnail'] = $request->file('thumbnail')->store('blogs', 'public');
        }

        Blog::create($validated);

        return redirect()->route('admin.blogs')->with('status', 'Blog post add ho gayi.');
    }

    public function update(Request $request, Blog $blog): RedirectResponse
    {
        $validated = $this->validateBlog($request);

        if ($request->hasFile('thumbnail')) {
            if ($blog->thumbnail) {
                Storage::disk('public')->delete($blog->thumbnail);
            }
            $validated['thumbnail'] = $request->file('thumbnail')->store('blogs', 'public');
        }

        $blog->update($validated);

        return redirect()->route('admin.blogs')->with('status', 'Blog post update ho gayi.');
    }

    public function destroy(Blog $blog): RedirectResponse
    {
        if ($blog->thumbnail) {
            Storage::disk('public')->delete($blog->thumbnail);
        }

        $blog->delete();

        return redirect()->route('admin.blogs')->with('status', 'Blog post delete ho gayi.');
    }

    private function validateBlog(Request $request): array
    {
        return $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'category' => ['nullable', 'string', 'max:100'],
            'excerpt' => ['nullable', 'string', 'max:500'],
            'content' => ['required', 'string'],
            'thumbnail' => ['nullable', 'image', 'max:2048'],
            'meta_title' => ['nullable', 'string', 'max:255'],
            'meta_description' => ['nullable', 'string', 'max:500'],
            'status' => ['nullable', 'in:Published,Draft'],
        ]);
    }
}
