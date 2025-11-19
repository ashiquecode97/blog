<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    public function run(): void
    {
        $posts = [
            [
                'title' => 'Getting Started with Laravel 11',
                'excerpt' => 'Learn the fundamentals of Laravel framework and start building modern web applications.',
                'content' => "Laravel is a powerful PHP framework that makes web development enjoyable and efficient. In this comprehensive guide, we'll explore the core concepts of Laravel including routing, controllers, models, and views.\n\nLaravel provides an elegant syntax and robust features out of the box. Whether you're building a simple blog or a complex enterprise application, Laravel has the tools you need to succeed.\n\nKey features include:\n- Eloquent ORM for database interactions\n- Blade templating engine\n- Built-in authentication and authorization\n- Database migrations and seeders\n- Queue management for background jobs\n- RESTful API development tools\n\nBy the end of this tutorial, you'll be able to create your own Laravel applications with confidence.",
                'featured_image' => 'https://images.unsplash.com/photo-1555066931-4365d14bab8c?w=800',
                'is_published' => true,
                'published_at' => now()->subDays(7),
            ],
            [
                'title' => 'Modern PHP Best Practices',
                'excerpt' => 'Discover the latest PHP standards and coding practices for professional development.',
                'content' => "PHP has evolved tremendously over the years. Modern PHP is fast, secure, and follows industry-standard best practices.\n\nIn this article, we'll cover:\n\n1. Type Declarations - Using strict types and return type declarations for better code quality\n2. Dependency Injection - Managing dependencies properly using containers\n3. PSR Standards - Following PHP-FIG recommendations\n4. Composer - Managing dependencies and autoloading\n5. Testing - Writing unit and feature tests with PHPUnit\n\nModern PHP development focuses on writing clean, maintainable, and testable code. By following these practices, you'll write better software that's easier to maintain and scale.",
                'featured_image' => 'https://images.unsplash.com/photo-1599507593499-a3f7d7d97667?w=800',
                'is_published' => true,
                'published_at' => now()->subDays(5),
            ],
            [
                'title' => 'Building RESTful APIs with Laravel',
                'excerpt' => 'A complete guide to creating robust and scalable APIs using Laravel framework.',
                'content' => "APIs are the backbone of modern web applications. Laravel makes it incredibly easy to build RESTful APIs with its powerful routing and resource controllers.\n\nIn this tutorial, you'll learn:\n\n- Setting up API routes\n- Creating resource controllers\n- API authentication with Sanctum\n- Request validation\n- API resources for data transformation\n- Error handling and responses\n- Rate limiting and throttling\n- API versioning strategies\n\nWe'll build a complete API from scratch, covering everything from basic CRUD operations to advanced features like file uploads and pagination.\n\nBy the end, you'll have all the knowledge needed to build production-ready APIs that can power mobile apps, SPAs, and third-party integrations.",
                'featured_image' => 'https://images.unsplash.com/photo-1558494949-ef010cbdcc31?w=800',
                'is_published' => true,
                'published_at' => now()->subDays(3),
            ],
            [
                'title' => 'Database Design Principles',
                'excerpt' => 'Master the art of designing efficient and scalable database schemas.',
                'content' => "Good database design is fundamental to building robust applications. A well-designed database improves performance, maintains data integrity, and makes your application easier to maintain.\n\nKey principles covered:\n\n1. Normalization - Organizing data to reduce redundancy\n2. Indexing - Improving query performance\n3. Relationships - One-to-many, many-to-many, and polymorphic relationships\n4. Foreign Keys - Maintaining referential integrity\n5. Query Optimization - Writing efficient database queries\n\nWe'll also discuss when to denormalize for performance and how to handle complex data relationships in Laravel using Eloquent ORM.\n\nUnderstanding these principles will help you build databases that scale and perform well under heavy load.",
                'featured_image' => 'https://images.unsplash.com/photo-1544383835-bda2bc66a55d?w=800',
                'is_published' => true,
                'published_at' => now()->subDays(2),
            ],
            [
                'title' => 'Frontend Development with Vue.js',
                'excerpt' => 'Learn how to build interactive user interfaces with Vue.js and Laravel.',
                'content' => "Vue.js is a progressive JavaScript framework that pairs perfectly with Laravel. Together, they create a powerful stack for building modern web applications.\n\nWhat you'll learn:\n\n- Vue.js fundamentals and component architecture\n- Integrating Vue with Laravel\n- State management with Pinia\n- API communication with Axios\n- Single Page Applications (SPAs)\n- Server-side rendering with Inertia.js\n\nVue's simplicity and flexibility make it an excellent choice for both small projects and large-scale applications. Its reactive data binding and component system allow you to build complex UIs with ease.\n\nWe'll build a real-world application demonstrating these concepts in action.",
                'featured_image' => 'https://images.unsplash.com/photo-1498050108023-c5249f4df085?w=800',
                'is_published' => true,
                'published_at' => now()->subDays(1),
            ],
            [
                'title' => 'Secure Your Laravel Application',
                'excerpt' => 'Essential security practices every Laravel developer should implement.',
                'content' => "Security should be a top priority in any web application. Laravel provides many security features out of the box, but you need to know how to use them properly.\n\nImportant security topics:\n\n1. Authentication & Authorization - Protecting routes and resources\n2. CSRF Protection - Preventing cross-site request forgery\n3. SQL Injection Prevention - Using query builders safely\n4. XSS Protection - Sanitizing user input\n5. Password Security - Hashing and secure storage\n6. API Security - Tokens and rate limiting\n7. HTTPS & SSL - Securing data in transit\n\nWe'll also cover common vulnerabilities and how to avoid them. Security is an ongoing process, and staying informed about best practices is crucial.\n\nLearn how to protect your application and your users' data from common attack vectors.",
                'featured_image' => 'https://images.unsplash.com/photo-1563986768609-322da13575f3?w=800',
                'is_published' => true,
                'published_at' => now(),
            ],
        ];

        foreach ($posts as $post) {
            Post::create($post);
        }
    }
}