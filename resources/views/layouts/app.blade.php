<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'My Blog')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .fade-in {
            animation: fadeIn 0.5s ease-out;
        }
    </style>
</head>
<body class="bg-gray-50 min-h-screen flex flex-col">
    <!-- Navigation -->
    <nav class="bg-white shadow-lg sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <a href="{{ route('home') }}" class="text-2xl font-bold bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">
                        MyBlog
                    </a>
                </div>
                <div class="flex items-center space-x-4">
                    <a href="{{ route('home') }}" 
                       class="text-gray-700 hover:text-blue-600 px-3 py-2 rounded-md transition {{ request()->routeIs('home') ? 'text-blue-600 font-semibold' : '' }}">
                        Home
                    </a>
                    <a href="{{ route('posts.index') }}" 
                       class="text-gray-700 hover:text-blue-600 px-3 py-2 rounded-md transition {{ request()->routeIs('posts.*') ? 'text-blue-600 font-semibold' : '' }}">
                        Blog
                    </a>
                     <a href="{{ route('student.list') }}" 
                       class="text-gray-700 hover:text-blue-600 px-3 py-2 rounded-md transition {{ request()->routeIs('posts.*') ? 'text-blue-600 font-semibold' : '' }}">
                        Student List
                    </a>
                    <a href="{{ route('posts.create') }}" 
                       class="bg-gradient-to-r from-blue-600 to-purple-600 text-white px-4 py-2 rounded-lg hover:shadow-lg transition transform hover:scale-105">
                        New Post
                    </a>
                    <a href="{{ route('posts.studentForm') }}" 
                       class="bg-gradient-to-r from-blue-600 to-purple-600 text-white px-4 py-2 rounded-lg hover:shadow-lg transition transform hover:scale-105">
                        student form
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Success Message -->
    @if(session('success'))
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded fade-in" role="alert">
            <p class="font-semibold">Success!</p>
            <p>{{ session('success') }}</p>
        </div>
    </div>
    @endif

    <!-- Main Content -->
    <main class="flex-grow py-8">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white mt-auto">
        <div class="max-w-7xl mx-auto px-4 py-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div>
                    <h3 class="text-xl font-bold mb-4">MyBlog</h3>
                    <p class="text-gray-400">Sharing knowledge and inspiring minds through quality content.</p>
                </div>
                <div>
                    <h3 class="text-xl font-bold mb-4">Quick Links</h3>
                    <ul class="space-y-2">
                        <li><a href="{{ route('home') }}" class="text-gray-400 hover:text-white transition">Home</a></li>
                        <li><a href="{{ route('posts.index') }}" class="text-gray-400 hover:text-white transition">All Posts</a></li>
                        <li><a href="{{ route('posts.create') }}" class="text-gray-400 hover:text-white transition">Write</a></li>
                        <li><a href="{{ route('posts.studentForm') }}" class="text-gray-400 hover:text-white transition">Students</a></li>
                        

                    </ul>
                </div>
                <div>
                    <h3 class="text-xl font-bold mb-4">Connect</h3>
                    <p class="text-gray-400">Follow us on social media for updates</p>
                </div>
            </div>
            <div class="border-t border-gray-700 mt-8 pt-8 text-center text-gray-400">
                <p>&copy; {{ date('Y') }} MyBlog. All rights reserved. Built with Laravel.</p>
            </div>
        </div>
    </footer>
</body>
</html>