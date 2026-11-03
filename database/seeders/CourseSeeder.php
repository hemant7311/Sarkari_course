<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Chapter;
use App\Models\Course;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class CourseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Ensure categories are standardized
        $bankingsCat = Category::where('name', 'Bankings')->first();
        if ($bankingsCat) {
            $bankingsCat->update(['name' => 'Banking', 'slug' => 'banking']);
        }

        $catNames = ['SSC', 'Railway', 'Banking', 'UPSC', 'Police', 'State Exams'];
        foreach ($catNames as $name) {
            Category::firstOrCreate(['name' => $name], ['slug' => \Illuminate\Support\Str::slug($name)]);
        }

        // 2. Ensure storage path for course thumbnails
        $targetDir = storage_path('app/public/courses');
        if (!File::exists($targetDir)) {
            File::makeDirectory($targetDir, 0755, true, true);
        }

        // Copy source images to storage/app/public/courses for thumbnails
        $imageMap = [
            'ssc_cgl' => public_path('images/hero/hero-student-laptop-new.jpg'),
            'rrb_ntpc' => public_path('images/courses/course-video-lessons-3d.webp'),
            'ibps_po' => public_path('images/about/about-hero-government-learning-3d.webp'),
            'upsc' => public_path('images/dashboard/student-dashboard-books-3d.webp'),
            'police_si' => public_path('images/hero/cta-books-new.jpg'),
            'state_pcs' => public_path('images/courses/course-achievement-trophy-3d.webp'),
            'ssc_chsl' => public_path('images/about/about-team-collaboration-3d.webp'),
            'sbi_clerk' => public_path('images/courses/courses-hero-education-3d.webp'),
        ];

        $copiedImages = [];
        foreach ($imageMap as $key => $src) {
            if (File::exists($src)) {
                $ext = pathinfo($src, PATHINFO_EXTENSION);
                $destName = "courses/{$key}_thumb.{$ext}";
                File::copy($src, storage_path("app/public/{$destName}"));
                $copiedImages[$key] = $destName;
            } else {
                $copiedImages[$key] = null;
            }
        }

        // Update existing test courses to have realistic names if present
        $existingHello = Course::where('title', 'hello')->first();
        if ($existingHello) {
            $existingHello->update([
                'title' => 'SSC GD Constable Selection Batch',
                'teacher_name' => 'Hemant Singh',
                'category' => 'SSC',
                'level' => 'Intermediate',
                'description' => 'Complete guidance, general reasoning, elementary mathematics, and Hindi/English for SSC GD Constable examination.',
            ]);
        }

        $existingConstable = Course::where('title', 'constable')->first();
        if ($existingConstable) {
            $existingConstable->update([
                'title' => 'State Police Constable Complete Course',
                'teacher_name' => 'Vikas Kumar',
                'category' => 'Police',
                'level' => 'Intermediate',
                'description' => 'Comprehensive batch for Police Constable aspirants including physical test prep tips and mental aptitude.',
            ]);
        }

        // New Courses to seed
        $coursesData = [
            [
                'title' => 'SSC CGL 2026 Complete Selection Batch (Tier 1 & Tier 2)',
                'teacher_name' => 'Rakesh Sharma',
                'category' => 'SSC',
                'level' => 'Intermediate',
                'price' => 0,
                'thumbnail' => $copiedImages['ssc_cgl'] ?? null,
                'description' => 'Complete preparation for SSC CGL Tier-1 and Tier-2 exams. Includes Maths, Reasoning, English, General Studies & Computer Knowledge with chapter-wise video lectures and practice tests.',
                'status' => 'Active',
                'chapters' => [
                    ['title' => 'SSC CGL 2026 Exam Pattern & Preparation Strategy', 'video_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ', 'duration_minutes' => 18, 'is_preview' => true],
                    ['title' => 'Quantitative Aptitude: Percentage & Profit Loss Tricks', 'video_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ', 'duration_minutes' => 45, 'is_preview' => false],
                    ['title' => 'English Language: Error Spotting & Grammar Rules', 'video_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ', 'duration_minutes' => 40, 'is_preview' => false],
                    ['title' => 'General Intelligence & Reasoning: Syllogism', 'video_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ', 'duration_minutes' => 35, 'is_preview' => false],
                    ['title' => 'General Awareness: Indian Constitution & Polity Highlights', 'video_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ', 'duration_minutes' => 50, 'is_preview' => false],
                ],
            ],
            [
                'title' => 'RRB NTPC & Group D Comprehensive Exam Batch',
                'teacher_name' => 'Er. Amit Verma',
                'category' => 'Railway',
                'level' => 'Beginner',
                'price' => 0,
                'thumbnail' => $copiedImages['rrb_ntpc'] ?? null,
                'description' => 'Specialized batch for Railway Recruitment Board (RRB) NTPC, Group D, ALP, and Technician exams. Covers Physics, Chemistry, Biology, Mathematics, and General Awareness.',
                'status' => 'Active',
                'chapters' => [
                    ['title' => 'RRB NTPC Syllabus Breakdown & Cut-Off Analysis', 'video_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ', 'duration_minutes' => 15, 'is_preview' => true],
                    ['title' => 'General Science: Class 10 Physics Numericals & Formulas', 'video_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ', 'duration_minutes' => 50, 'is_preview' => false],
                    ['title' => 'Railway Mathematics: Time, Speed & Trains Shortcuts', 'video_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ', 'duration_minutes' => 45, 'is_preview' => false],
                    ['title' => 'Reasoning: Coding-Decoding & Statement Assumptions', 'video_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ', 'duration_minutes' => 40, 'is_preview' => false],
                ],
            ],
            [
                'title' => 'IBPS PO & SBI PO Foundation Masterclass 2026',
                'teacher_name' => 'Ananya Sen',
                'category' => 'Banking',
                'level' => 'Advanced',
                'price' => 0,
                'thumbnail' => $copiedImages['ibps_po'] ?? null,
                'description' => 'Targeted course for SBI PO, IBPS PO, and RRB Officer Scale-1. Master Data Interpretation, High-level Puzzles, Financial Awareness, and English Comprehension.',
                'status' => 'Active',
                'chapters' => [
                    ['title' => 'Banking Exam Trend Analysis & Speed Calculation Shortcuts', 'video_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ', 'duration_minutes' => 20, 'is_preview' => true],
                    ['title' => 'Data Interpretation: Tabular & Pie Chart DI Tricks', 'video_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ', 'duration_minutes' => 50, 'is_preview' => false],
                    ['title' => 'Banking & Financial Awareness: RBI Monetary Policy 2026', 'video_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ', 'duration_minutes' => 45, 'is_preview' => false],
                    ['title' => 'Advanced Puzzles: Circular & Floor-based Arrangements', 'video_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ', 'duration_minutes' => 55, 'is_preview' => false],
                ],
            ],
            [
                'title' => 'UPSC CSE General Studies Prelims & Mains Foundation',
                'teacher_name' => 'Dr. Suresh Kumar',
                'category' => 'UPSC',
                'level' => 'Advanced',
                'price' => 0,
                'thumbnail' => $copiedImages['upsc'] ?? null,
                'description' => 'In-depth coverage of UPSC Civil Services Examination General Studies Paper I to IV. Includes Indian History, Polity, Geography, Economy, Environment, and Ethics.',
                'status' => 'Active',
                'chapters' => [
                    ['title' => 'UPSC Preparation Roadmap & Answer Writing Techniques', 'video_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ', 'duration_minutes' => 25, 'is_preview' => true],
                    ['title' => 'Indian Polity: Preamble, Fundamental Rights & DPSP', 'video_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ', 'duration_minutes' => 60, 'is_preview' => false],
                    ['title' => 'Modern History: Indian Freedom Movement 1857-1947', 'video_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ', 'duration_minutes' => 55, 'is_preview' => false],
                    ['title' => 'Indian Economy: Macroeconomic Concepts & Budget', 'video_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ', 'duration_minutes' => 50, 'is_preview' => false],
                ],
            ],
            [
                'title' => 'UP Police SI & Sub-Inspector Special Selection Batch',
                'teacher_name' => 'Inspector Alok Singh',
                'category' => 'Police',
                'level' => 'Intermediate',
                'price' => 0,
                'thumbnail' => $copiedImages['police_si'] ?? null,
                'description' => 'Complete preparation for Police Constable and Sub-Inspector (SI) examinations. Special focus on Mool Vidhi (Basic Law), Samanya Hindi, Mental Aptitude & Reasoning.',
                'status' => 'Active',
                'chapters' => [
                    ['title' => 'UP Police SI Exam Pattern & Physical Standard Tests', 'video_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ', 'duration_minutes' => 15, 'is_preview' => true],
                    ['title' => 'Mool Vidhi: Bharatiya Nyaya Sanhita & Traffic Rules', 'video_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ', 'duration_minutes' => 45, 'is_preview' => false],
                    ['title' => 'Samanya Hindi: Sandhi, Samas & Muhavare Masterclass', 'video_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ', 'duration_minutes' => 50, 'is_preview' => false],
                    ['title' => 'Mental Ability & Intelligence Test Practice', 'video_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ', 'duration_minutes' => 40, 'is_preview' => false],
                ],
            ],
            [
                'title' => 'State PCS (UPPSC / BPSC / MPPSC) Samagra Batch',
                'teacher_name' => 'Dr. Ramesh Chandra',
                'category' => 'State Exams',
                'level' => 'Intermediate',
                'price' => 0,
                'thumbnail' => $copiedImages['state_pcs'] ?? null,
                'description' => 'Dedicated batch for State Public Service Commission Prelims & Mains exams. Comprehensive state-specific General Knowledge, History, Culture, and Administrative setup.',
                'status' => 'Active',
                'chapters' => [
                    ['title' => 'State PCS Exam Strategy & Previous Year Analysis', 'video_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ', 'duration_minutes' => 20, 'is_preview' => true],
                    ['title' => 'State Geography, Climate & Natural Resources', 'video_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ', 'duration_minutes' => 45, 'is_preview' => false],
                    ['title' => 'State History & Cultural Heritage Overview', 'video_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ', 'duration_minutes' => 50, 'is_preview' => false],
                    ['title' => 'State Schemes & Current Affairs 2026', 'video_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ', 'duration_minutes' => 40, 'is_preview' => false],
                ],
            ],
            [
                'title' => 'SSC CHSL (10+2) Tier-1 Speed Booster & Mock Test Batch',
                'teacher_name' => 'Neha Sharma',
                'category' => 'SSC',
                'level' => 'Beginner',
                'price' => 0,
                'thumbnail' => $copiedImages['ssc_chsl'] ?? null,
                'description' => 'Designed for 10+2 students aspiring for SSC CHSL positions (LDC, JSA, DEO). Speed math shortcuts, rapid grammar rules, and previous year paper solutions.',
                'status' => 'Active',
                'chapters' => [
                    ['title' => 'SSC CHSL Tier-1 Cutoff Trends & Speed Tricks', 'video_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ', 'duration_minutes' => 15, 'is_preview' => true],
                    ['title' => 'Quantitative Aptitude: Algebra & Trigonometry Formulae', 'video_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ', 'duration_minutes' => 45, 'is_preview' => false],
                    ['title' => 'English Language: Sentence Improvement & Cloze Test', 'video_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ', 'duration_minutes' => 40, 'is_preview' => false],
                ],
            ],
            [
                'title' => 'SBI Clerk & IBPS RRB Assistant Target Batch',
                'teacher_name' => 'Er. Rajesh Patel',
                'category' => 'Banking',
                'level' => 'Beginner',
                'price' => 0,
                'thumbnail' => $copiedImages['sbi_clerk'] ?? null,
                'description' => 'Fast-track course for Banking Clerical & Assistant cadre. Focuses on maximum speed in Numerical Ability, Reasoning Ability, and Computer Awareness.',
                'status' => 'Active',
                'chapters' => [
                    ['title' => 'SBI Clerk Numerical Ability 35/35 Strategy', 'video_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ', 'duration_minutes' => 18, 'is_preview' => true],
                    ['title' => 'Speed Calculation: Squares, Cubes & Simplification', 'video_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ', 'duration_minutes' => 40, 'is_preview' => false],
                    ['title' => 'Reasoning Ability: Inequality & Syllogism Tricks', 'video_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ', 'duration_minutes' => 45, 'is_preview' => false],
                ],
            ],
        ];

        foreach ($coursesData as $item) {
            $chapters = $item['chapters'] ?? [];
            unset($item['chapters']);

            $course = Course::updateOrCreate(
                ['title' => $item['title']],
                $item
            );

            // Add chapters if not already added
            if ($course->chapters()->count() === 0) {
                foreach ($chapters as $index => $ch) {
                    Chapter::create([
                        'course_id' => $course->id,
                        'title' => $ch['title'],
                        'video_url' => $ch['video_url'],
                        'duration_minutes' => $ch['duration_minutes'],
                        'sort_order' => $index + 1,
                        'is_preview' => $ch['is_preview'],
                    ]);
                }
            }
        }
    }
}
