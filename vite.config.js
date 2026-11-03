import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/css/fonts.css',
                'resources/css/design-system.css',
                'resources/css/header.css',
                'resources/js/header.js',
                'resources/js/three-loader.js',
                'resources/js/sc-animations.js',
                'resources/js/ai-chat.js',
                'resources/js/sc-lottie.js',
                'resources/css/home.css',
                'resources/css/about.css',
                'resources/css/services.css',
                'resources/css/courses.css',
                'resources/css/course_details.css',
                'resources/css/blog.css',
                'resources/css/blog_details.css',
                'resources/css/contact.css',
                'resources/css/search-results.css',
                'resources/css/error-pages.css',
                'resources/css/legal.css',
                'resources/css/auth.css',
                'resources/css/dashboard.css',
                'resources/css/ai-chat.css',
                'resources/css/admin.css',
                'resources/css/footer.css',
            ],
            refresh: true,
        }),
    ],
});
