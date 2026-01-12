<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>CricLife Cricket Academy - All Matches</title>
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>

<body class="bg-white min-h-screen">
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <aside class="w-64 bg-slate-900 flex flex-col min-h-screen">
            <div class="flex items-center justify-center h-20">
                <span class="text-teal-500 text-4xl font-semibold font-poppins">C</span>
                <span class="text-white text-4xl font-semibold font-poppins">ric</span>
                <span class="text-teal-500 text-4xl font-semibold font-poppins">L</span>
                <span class="text-white text-4xl font-semibold font-poppins">ife</span>
            </div>
            <nav class="flex-1 mt-6">
                <ul class="space-y-1">
                    <li>
                        <a href="{{ route('superadmin.dashboard') }}"
                            class="flex items-center px-6 py-3 text-gray-300 hover:bg-slate-800 hover:text-white transition">
                            <span class="material-icons mr-3">dashboard</span>
                            Dashboard
                        </a>
                    </li>
                    <li>
                        <div class="flex items-center px-6 py-3 text-white font-semibold rounded-l-full cursor-default">
                            <span class="material-icons mr-3">sports_cricket</span>
                            Players
                        </div>
                        <ul class="ml-8 space-y-1">
                            <li>
                                <a href="{{ route('players.create') }}"
                                    class="flex items-center px-6 py-3 text-gray-300 hover:bg-slate-800 hover:text-white transition">
                                    <span class="material-icons mr-3">person_add</span>
                                    Add Player
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('players.index') }}"
                                    class="flex items-center px-6 py-3 text-gray-300 hover:bg-slate-800 hover:text-white transition">
                                    <span class="material-icons mr-3">list</span>
                                    All Players
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <div class="flex items-center px-6 py-3 text-white font-semibold rounded-l-full cursor-default">
                            <span class="material-icons mr-3">person</span>
                            Coaches
                        </div>
                        <ul class="ml-8 space-y-1">
                            <li>
                                <a href="{{ route('coaches.create') }}"
                                    class="flex items-center px-6 py-3 text-gray-300 hover:bg-slate-800 hover:text-white transition">
                                    <span class="material-icons mr-3">person_add</span>
                                    Add Coach
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('coaches.index') }}"
                                    class="flex items-center px-6 py-3 text-gray-300 hover:bg-slate-800 hover:text-white transition">
                                    <span class="material-icons mr-3">list</span>
                                    All Coaches
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <div class="flex items-center px-6 py-3 text-white font-semibold rounded-l-full cursor-default">
                            <span class="material-icons mr-3">sports</span>
                            Matches
                        </div>
                        <ul class="ml-8 space-y-1">
                            <li>
                                <a href="{{ route('matches.create') }}"
                                    class="flex items-center px-6 py-3 text-gray-300 hover:bg-slate-800 hover:text-white transition">
                                    <span class="material-icons mr-3">add</span>
                                    Add Match
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('matches.index') }}"
                                    class="flex items-center px-6 py-3 text-teal-500 font-semibold bg-slate-800 rounded-l-full">
                                    <span class="material-icons mr-3">list</span>
                                    All Matches
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </nav>
        </aside>
        <!-- Main Content -->
        <div class="flex-1 flex flex-col min-h-screen bg-gray-50">
            <!-- Header -->
            <header class="w-full h-20 bg-white border-b border-gray-200 flex items-center px-8">
                <div class="w-full flex justify-between items-center">
                    <div class="flex items-center gap-2">
                        <span class="material-icons text-gray-400">list</span>
                        <span class="text-xl font-semibold font-poppins text-gray-900">All Matches</span>
                    </div>
                    <div class="flex items-center space-x-6">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-responsive-nav-link :href="route('logout')"
                                onclick="event.preventDefault();
                                                    this.closest('form').submit();">
                                {{ __('LogOut') }}
                            </x-responsive-nav-link>
                        </form>
                    </div>
                </div>
            </header>
            <main class="flex-1 w-full px-8 py-8 overflow-y-auto">
                <!-- Success Message -->
                @if (session('success'))
                    <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative"
                        role="alert">
                        <span class="block sm:inline">{{ session('success') }}</span>
                    </div>
                @endif

                <!-- Header Actions -->
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-semibold text-gray-800 flex items-center">
                        <span class="material-icons mr-2 text-teal-500">sports</span>
                        Matches List
                    </h2>
                    <a href="{{ route('matches.create') }}"
                        class="px-4 py-2 bg-teal-500 text-white rounded-lg hover:bg-teal-600 transition flex items-center">
                        <span class="material-icons mr-2 text-sm">add</span>
                        Add New Match
                    </a>
                </div>

                <!-- Matches Grid -->
                @if ($matches->count() > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">
                        @foreach ($matches as $match)
                            <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300 overflow-hidden border border-gray-200">
                                <!-- Card Header -->
                                <div class="bg-gradient-to-r from-teal-500 to-teal-600 px-6 py-4">
                                    <div class="flex items-center justify-between">
                                        <span class="text-white text-xs font-semibold uppercase tracking-wider">
                                            Match #{{ $match->id }}
                                        </span>
                                        <span class="material-icons text-white text-sm">sports</span>
                                    </div>
                                </div>

                                <!-- Card Body -->
                                <div class="p-6">
                                    <!-- Teams -->
                                    <div class="mb-4">
                                        <div class="text-lg font-bold text-gray-900 text-center mb-2">
                                            {{ $match->team_1 }}
                                        </div>
                                        <div class="text-center text-gray-500 text-sm font-medium mb-2">VS</div>
                                        <div class="text-lg font-bold text-gray-900 text-center">
                                            {{ $match->team_2 }}
                                        </div>
                                    </div>

                                    <div class="border-t border-gray-200 pt-4 space-y-3">
                                        <!-- Date -->
                                        <div class="flex items-center text-sm text-gray-600">
                                            <span class="material-icons text-gray-400 mr-2 text-base">calendar_today</span>
                                            <span class="font-medium">Date:</span>
                                            <span class="ml-2">
                                                @if ($match->date)
                                                    {{ \Carbon\Carbon::parse($match->date)->format('M d, Y') }}
                                                @else
                                                    <span class="text-gray-400">N/A</span>
                                                @endif
                                            </span>
                                        </div>

                                        <!-- Venue -->
                                        <div class="flex items-start text-sm text-gray-600">
                                            <span class="material-icons text-gray-400 mr-2 text-base">location_on</span>
                                            <span class="font-medium">Venue:</span>
                                            <span class="ml-2 flex-1">{{ $match->venue ?? 'N/A' }}</span>
                                        </div>

                                        <!-- Type and Level -->
                                        <div class="flex flex-wrap gap-2">
                                            @if ($match->type)
                                                <span
                                                    class="px-3 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">
                                                    {{ $match->type }}
                                                </span>
                                            @endif
                                            @if ($match->level)
                                                <span
                                                    class="px-3 py-1 text-xs font-semibold rounded-full bg-purple-100 text-purple-800">
                                                    {{ $match->level }}
                                                </span>
                                            @endif
                                        </div>

                                        <!-- Notes -->
                                        <div class="pt-2 border-t border-gray-100">
                                            <p class="text-xs text-gray-500 line-clamp-2">
                                                <span class="font-medium">Note:</span> {{ $match->note ?? 'N/A' }}
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Card Footer -->
                                <div class="bg-gray-50 px-6 py-4 border-t border-gray-200">
                                    <div class="flex justify-end space-x-2">
                                        <a href="{{ route('matches.show', $match) }}"
                                            class="inline-flex items-center px-3 py-2 bg-teal-500 text-white text-sm font-medium rounded-lg hover:bg-teal-600 transition-colors duration-200"
                                            title="View">
                                            <span class="material-icons text-sm">visibility</span>
                                        </a>
                                        <a href="{{ route('matches.edit', $match) }}"
                                            class="inline-flex items-center px-3 py-2 bg-blue-500 text-white text-sm font-medium rounded-lg hover:bg-blue-600 transition-colors duration-200"
                                            title="Edit">
                                            <span class="material-icons text-sm">edit</span>
                                        </a>
                                        <form action="{{ route('matches.destroy', $match) }}" method="POST"
                                            class="inline"
                                            onsubmit="return confirm('Are you sure you want to delete this match?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="inline-flex items-center px-3 py-2 bg-red-500 text-white text-sm font-medium rounded-lg hover:bg-red-600 transition-colors duration-200"
                                                title="Delete">
                                                <span class="material-icons text-sm">delete</span>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    <div class="bg-white px-4 py-3 rounded-lg shadow-md border border-gray-200">
                        {{ $matches->links() }}
                    </div>
                @else
                    <div class="bg-white rounded-lg shadow-md border border-gray-200">
                        <div class="text-center py-12">
                            <span class="material-icons text-gray-400 text-6xl mb-4">sports</span>
                            <h3 class="text-lg font-medium text-gray-900 mb-2">No matches found</h3>
                            <p class="text-gray-500 mb-4">Get started by adding a new match.</p>
                            <a href="{{ route('matches.create') }}"
                                class="inline-flex items-center px-4 py-2 bg-teal-500 text-white rounded-lg hover:bg-teal-600 transition">
                                <span class="material-icons mr-2 text-sm">add</span>
                                Add New Match
                            </a>
                        </div>
                    </div>
                @endif
            </main>
        </div>
    </div>
</body>

</html>
