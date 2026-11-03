<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Course;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    public function index(): Response
    {
        $urls = collect([
            ['loc' => route('home'), 'priority' => '1.0'],
            ['loc' => route('about'), 'priority' => '0.7'],
            ['loc' => route('services'), 'priority' => '0.7'],
            ['loc' => route('courses'), 'priority' => '0.9'],
            ['loc' => route('blog'), 'priority' => '0.8'],
            ['loc' => route('contact'), 'priority' => '0.5'],
        ]);

        Course::active()->get()->each(function ($course) use ($urls) {
            $urls->push(['loc' => route('course_details', $course), 'priority' => '0.8']);
        });

        Blog::published()->get()->each(function ($blog) use ($urls) {
            $urls->push(['loc' => route('blog.show', $blog), 'priority' => '0.6']);
        });

        $xml = view('sitemap', compact('urls'))->render();

        return response($xml, 200)->header('Content-Type', 'application/xml');
    }
}
