<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Universities') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Search and Filter Section -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900">
                    <form method="GET" action="{{ route('universities.index') }}" class="space-y-4">
                        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                            <!-- Search Input -->
                            <div>
                                <label for="search" class="block text-sm font-medium text-gray-700 mb-1">Search</label>
                                <input type="text" 
                                       name="search" 
                                       id="search"
                                       value="{{ request('search') }}"
                                       placeholder="Search universities..."
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>

                            <!-- Country Filter -->
                            <div>
                                <label for="country" class="block text-sm font-medium text-gray-700 mb-1">Country</label>
                                <select name="country" 
                                        id="country"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <option value="">All Countries</option>
                                    @foreach($countries as $country)
                                        <option value="{{ $country }}" {{ request('country') == $country ? 'selected' : '' }}>
                                            {{ $country }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Program Filter -->
                            <div>
                                <label for="program" class="block text-sm font-medium text-gray-700 mb-1">Program</label>
                                <select name="program" 
                                        id="program"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <option value="">All Programs</option>
                                    @foreach($programs as $program)
                                        <option value="{{ $program }}" {{ request('program') == $program ? 'selected' : '' }}>
                                            {{ $program }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Sort Filter -->
                            <div>
                                <label for="sort" class="block text-sm font-medium text-gray-700 mb-1">Sort By</label>
                                <select name="sort" 
                                        id="sort"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <option value="qs_ranking" {{ request('sort') == 'qs_ranking' ? 'selected' : '' }}>QS Ranking</option>
                                    <option value="name" {{ request('sort') == 'name' ? 'selected' : '' }}>Name</option>
                                    <option value="tuition" {{ request('sort') == 'tuition' ? 'selected' : '' }}>Tuition Fee</option>
                                </select>
                            </div>
                        </div>

                        <div class="flex justify-between items-center">
                            <button type="submit" 
                                    class="bg-blue-600 text-white px-6 py-2 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                Search
                            </button>
                            
                            <a href="{{ route('universities.index') }}" 
                               class="text-gray-600 hover:text-gray-800">
                                Clear Filters
                            </a>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Results Count -->
            <div class="mb-4">
                <p class="text-gray-600">
                    Showing {{ $universities->count() }} of {{ $universities->total() }} universities
                </p>
            </div>

            <!-- Universities Grid -->
            @if($universities->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($universities as $university)
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg hover:shadow-lg transition duration-300">
                            <!-- University Logo/Image -->
                            <div class="h-48 bg-gradient-to-r from-blue-400 to-purple-500 flex items-center justify-center">
                                @if($university->logo)
                                    <img src="{{ $university->logo }}" alt="{{ $university->name }}" class="max-h-32 max-w-full">
                                @else
                                    <span class="text-white text-3xl font-bold">
                                        {{ substr($university->name, 0, 2) }}
                                    </span>
                                @endif
                            </div>

                            <div class="p-6">
                                <h3 class="text-xl font-semibold text-gray-900 mb-2">{{ $university->name }}</h3>
                                <p class="text-gray-600 mb-2">{{ $university->city }}, {{ $university->country }}</p>
                                
                                @if($university->qs_ranking)
                                    <div class="flex items-center mb-2">
                                        <span class="bg-blue-100 text-blue-800 text-xs font-semibold px-2 py-1 rounded">
                                            QS #{{ $university->qs_ranking }}
                                        </span>
                                        @if($university->times_ranking)
                                            <span class="bg-green-100 text-green-800 text-xs font-semibold px-2 py-1 rounded ml-2">
                                                THE #{{ $university->times_ranking }}
                                            </span>
                                        @endif
                                    </div>
                                @endif

                                <p class="text-gray-700 text-sm mb-4">{{ Str::limit($university->description, 120) }}</p>

                                @if($university->tuition_fee_min)
                                    <div class="mb-4">
                                        <span class="text-sm text-gray-600">Tuition: </span>
                                        <span class="font-semibold text-green-600">
                                            {{ number_format($university->tuition_fee_min) }} - {{ number_format($university->tuition_fee_max) }} {{ $university->currency }}
                                        </span>
                                    </div>
                                @endif

                                @if($university->programs)
                                    <div class="mb-4">
                                        <div class="flex flex-wrap gap-1">
                                            @foreach(array_slice($university->programs, 0, 3) as $program)
                                                <span class="bg-gray-100 text-gray-700 text-xs px-2 py-1 rounded">
                                                    {{ $program }}
                                                </span>
                                            @endforeach
                                            @if(count($university->programs) > 3)
                                                <span class="text-gray-500 text-xs">+{{ count($university->programs) - 3 }} more</span>
                                            @endif
                                        </div>
                                    </div>
                                @endif

                                <div class="flex justify-between items-center">
                                    <a href="{{ route('universities.show', $university) }}" 
                                       class="text-blue-600 font-semibold hover:text-blue-800">
                                        View Details →
                                    </a>
                                    @if($university->website)
                                        <a href="{{ $university->website }}" 
                                           target="_blank"
                                           class="text-gray-500 hover:text-gray-700">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                                            </svg>
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-8">
                    {{ $universities->links() }}
                </div>
            @else
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-center text-gray-900">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900">No universities found</h3>
                        <p class="mt-1 text-sm text-gray-500">Try adjusting your search criteria.</p>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>