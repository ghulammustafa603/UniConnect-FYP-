<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('UniConnect - Connecting Students to Universities, Scholarships, and Alumni') }}
        </h2>
    </x-slot>

    <!-- Hero Section -->
    <div class="bg-gradient-to-r from-blue-600 to-purple-600 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
            <div class="text-center">
                <h1 class="text-4xl md:text-6xl font-bold mb-6">
                    Your Gateway to Higher Education
                </h1>
                <p class="text-xl md:text-2xl mb-8 max-w-3xl mx-auto">
                    Discover universities, find scholarships, and connect with alumni mentors all in one place.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('universities.index') }}" 
                       class="bg-white text-blue-600 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition duration-300">
                        Explore Universities
                    </a>
                    <a href="{{ route('scholarships.index') }}" 
                       class="bg-transparent border-2 border-white text-white px-8 py-3 rounded-lg font-semibold hover:bg-white hover:text-blue-600 transition duration-300">
                        Find Scholarships
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Features Section -->
    <div class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">Why Choose UniConnect?</h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    We provide comprehensive tools and resources to help you make informed decisions about your higher education journey.
                </p>
            </div>
            
            <div class="grid md:grid-cols-3 gap-8">
                <div class="bg-white p-6 rounded-lg shadow-md text-center">
                    <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Smart Search & Filter</h3>
                    <p class="text-gray-600">Find universities and scholarships based on your preferences, location, and eligibility criteria.</p>
                </div>
                
                <div class="bg-white p-6 rounded-lg shadow-md text-center">
                    <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Eligibility Checker</h3>
                    <p class="text-gray-600">Quickly check if you meet the requirements for universities and scholarships.</p>
                </div>
                
                <div class="bg-white p-6 rounded-lg shadow-md text-center">
                    <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Alumni Network</h3>
                    <p class="text-gray-600">Connect with alumni and current students for mentorship and guidance.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Featured Universities Section -->
    @if($featuredUniversities->count() > 0)
    <div class="py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">Top Universities</h2>
                <p class="text-lg text-gray-600">Discover world-class universities and their programs</p>
            </div>
            
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($featuredUniversities as $university)
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition duration-300">
                    @if($university->logo)
                    <div class="h-48 bg-gray-200 flex items-center justify-center">
                        <img src="{{ $university->logo }}" alt="{{ $university->name }}" class="max-h-32 max-w-full">
                    </div>
                    @else
                    <div class="h-48 bg-gradient-to-r from-blue-400 to-purple-500 flex items-center justify-center">
                        <span class="text-white text-2xl font-bold">{{ substr($university->name, 0, 2) }}</span>
                    </div>
                    @endif
                    
                    <div class="p-6">
                        <h3 class="text-xl font-semibold mb-2">{{ $university->name }}</h3>
                        <p class="text-gray-600 mb-2">{{ $university->city }}, {{ $university->country }}</p>
                        @if($university->qs_ranking)
                        <p class="text-sm text-blue-600 mb-3">QS Ranking: #{{ $university->qs_ranking }}</p>
                        @endif
                        <p class="text-gray-700 text-sm mb-4">{{ Str::limit($university->description, 100) }}</p>
                        <a href="{{ route('universities.show', $university) }}" 
                           class="text-blue-600 font-semibold hover:text-blue-800">Learn More →</a>
                    </div>
                </div>
                @endforeach
            </div>
            
            <div class="text-center mt-8">
                <a href="{{ route('universities.index') }}" 
                   class="bg-blue-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-blue-700 transition duration-300">
                    View All Universities
                </a>
            </div>
        </div>
    </div>
    @endif

    <!-- Recent Scholarships Section -->
    @if($recentScholarships->count() > 0)
    <div class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">Latest Scholarships</h2>
                <p class="text-lg text-gray-600">Don't miss out on these funding opportunities</p>
            </div>
            
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($recentScholarships as $scholarship)
                <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition duration-300">
                    <h3 class="text-xl font-semibold mb-2">{{ $scholarship->title }}</h3>
                    @if($scholarship->university)
                    <p class="text-gray-600 mb-2">{{ $scholarship->university->name }}</p>
                    @endif
                    @if($scholarship->amount)
                    <p class="text-green-600 font-semibold mb-2">
                        {{ number_format($scholarship->amount) }} {{ $scholarship->currency }}
                    </p>
                    @endif
                    <p class="text-gray-700 text-sm mb-4">{{ Str::limit($scholarship->description, 120) }}</p>
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-500">
                            Deadline: {{ $scholarship->application_deadline->format('M d, Y') }}
                        </span>
                        <a href="{{ route('scholarships.show', $scholarship) }}" 
                           class="text-blue-600 font-semibold hover:text-blue-800">View Details →</a>
                    </div>
                </div>
                @endforeach
            </div>
            
            <div class="text-center mt-8">
                <a href="{{ route('scholarships.index') }}" 
                   class="bg-green-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-green-700 transition duration-300">
                    View All Scholarships
                </a>
            </div>
        </div>
    </div>
    @endif

    <!-- Featured Posts Section -->
    @if($featuredPosts->count() > 0)
    <div class="py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">Community Insights</h2>
                <p class="text-lg text-gray-600">Learn from the experiences of students and alumni</p>
            </div>
            
            <div class="grid md:grid-cols-3 gap-6">
                @foreach($featuredPosts as $post)
                <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition duration-300">
                    <div class="flex items-center mb-4">
                        @if($post->userProfile && $post->userProfile->profile_picture)
                        <img src="{{ $post->userProfile->profile_picture }}" 
                             alt="{{ $post->userProfile->full_name }}" 
                             class="w-10 h-10 rounded-full mr-3">
                        @else
                        <div class="w-10 h-10 bg-gray-300 rounded-full flex items-center justify-center mr-3">
                            <span class="text-gray-600 font-semibold">
                                {{ substr($post->userProfile->full_name ?? 'A', 0, 1) }}
                            </span>
                        </div>
                        @endif
                        <div>
                            <p class="font-semibold">{{ $post->userProfile->full_name ?? 'Anonymous' }}</p>
                            <p class="text-sm text-gray-500">{{ $post->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
                    <h3 class="text-lg font-semibold mb-2">{{ $post->title }}</h3>
                    <p class="text-gray-700 text-sm mb-4">{{ Str::limit($post->content, 100) }}</p>
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-blue-600 bg-blue-100 px-2 py-1 rounded">
                            {{ ucfirst($post->post_type) }}
                        </span>
                        <a href="{{ route('networking.show', $post) }}" 
                           class="text-blue-600 font-semibold hover:text-blue-800">Read More →</a>
                    </div>
                </div>
                @endforeach
            </div>
            
            <div class="text-center mt-8">
                <a href="{{ route('networking.index') }}" 
                   class="bg-purple-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-purple-700 transition duration-300">
                    Join the Community
                </a>
            </div>
        </div>
    </div>
    @endif

    <!-- CTA Section -->
    <div class="bg-blue-600 text-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl font-bold mb-4">Ready to Start Your Journey?</h2>
            <p class="text-xl mb-8 max-w-2xl mx-auto">
                Join thousands of students who have found their perfect university and scholarship opportunities through UniConnect.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                @auth
                    <a href="{{ route('profile.show') }}" 
                       class="bg-white text-blue-600 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition duration-300">
                        Complete Your Profile
                    </a>
                @else
                    <a href="{{ route('register') }}" 
                       class="bg-white text-blue-600 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition duration-300">
                        Get Started Free
                    </a>
                @endauth
                <a href="{{ route('scholarships.eligibility-check') }}" 
                   class="bg-transparent border-2 border-white text-white px-8 py-3 rounded-lg font-semibold hover:bg-white hover:text-blue-600 transition duration-300">
                    Check Eligibility
                </a>
            </div>
        </div>
    </div>
</x-app-layout>