<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>CricLife Cricket Academy - Add Match</title>
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
                                    class="flex items-center px-6 py-3 text-teal-500 font-semibold bg-slate-800 rounded-l-full">
                                    <span class="material-icons mr-3">add</span>
                                    Add Match
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('matches.index') }}"
                                    class="flex items-center px-6 py-3 text-gray-300 hover:bg-slate-800 hover:text-white transition">
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
                        <span class="material-icons text-gray-400">add</span>
                        <span class="text-xl font-semibold font-poppins text-gray-900">Add Match</span>
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

                <!-- Error Messages -->
                @if ($errors->any())
                    <div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative"
                        role="alert">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Form Card -->
                <div class="bg-white rounded-lg shadow-md p-8">
                    <h2 class="text-2xl font-semibold text-gray-800 mb-6 flex items-center">
                        <span class="material-icons mr-2 text-teal-500">sports</span>
                        Match Information
                    </h2>

                    <form method="POST" action="{{ route('matches.store') }}" class="space-y-6">
                        @csrf

                        <!-- Teams Information -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Team 1 -->
                            <div>
                                <label for="team_1" class="block text-sm font-medium text-gray-700 mb-2">
                                    Home Team <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="team_1" id="team_1" value="{{ old('team_1') }}"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent @error('team_1') border-red-500 @enderror"
                                    placeholder="e.g., CricLife Blue " required>
                                @error('team_1')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Team 2 -->
                            <div>
                                <label for="team_2" class="block text-sm font-medium text-gray-700 mb-2">
                                    Away Team <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="team_2" id="team_2" value="{{ old('team_2') }}"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent @error('team_2') border-red-500 @enderror"
                                    placeholder="e.g., CricLife Red" required>
                                @error('team_2')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Match Details -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Date -->
                            <div>
                                <label for="date" class="block text-sm font-medium text-gray-700 mb-2">
                                    Match Date <span class="text-red-500">*</span>
                                </label>
                                <input type="date" name="date" id="date" value="{{ old('date') }}"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent @error('date') border-red-500 @enderror"
                                    required>
                                @error('date')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Venue -->
                            <div>
                                <label for="venue" class="block text-sm font-medium text-gray-700 mb-2">
                                    Venue <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="venue" id="venue" value="{{ old('venue') }}"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent @error('venue') border-red-500 @enderror"
                                    placeholder="e.g., DCA Ground, Anuradhapura" required>
                                @error('venue')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Match Type and Level -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Type -->
                            <div>
                                <label for="type" class="block text-sm font-medium text-gray-700 mb-2">
                                    Match Type <span class="text-red-500">*</span>
                                </label>
                                <select name="type" id="type"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent @error('type') border-red-500 @enderror"
                                    required>
                                    <option value="">Select Match Type</option>
                                    <option value="One Day" {{ old('type') == 'One Day' ? 'selected' : '' }}>One Day</option>
                                    <option value="2 Day" {{ old('type') == '2 Day' ? 'selected' : '' }}>2 Day</option>
                                    <option value="3 Day" {{ old('type') == '3 Day' ? 'selected' : '' }}>3 Day</option>
                                    <option value="T20" {{ old('type') == 'T20' ? 'selected' : '' }}>T20</option>
                                    <option value="T10" {{ old('type') == 'T10' ? 'selected' : '' }}>T10</option>
                                    <option value="Limited Overs One Day" {{ old('type') == 'Limited Overs One Day' ? 'selected' : '' }}>Limited Overs One Day</option>
                                    <option value="Other" {{ old('type') == 'Other' ? 'selected' : '' }}>Other</option>
                                </select>
                                @error('type')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Level -->
                            <div>
                                <label for="level" class="block text-sm font-medium text-gray-700 mb-2">
                                    Match Level <span class="text-red-500">*</span>
                                </label>
                                <select name="level" id="level"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent @error('level') border-red-500 @enderror"
                                    required>
                                    <option value="">Select Match Level</option>
                                    <option value="U 09" {{ old('level') == 'U 09' ? 'selected' : '' }}>U 09</option>
                                    <option value="U 11" {{ old('level') == 'U 11' ? 'selected' : '' }}>U 11</option>
                                    <option value="U 13" {{ old('level') == 'U 13' ? 'selected' : '' }}>U 13</option>
                                    <option value="U 15" {{ old('level') == 'U 15' ? 'selected' : '' }}>U 15</option>
                                    <option value="U 17" {{ old('level') == 'U 17' ? 'selected' : '' }}>U 17</option>
                                    <option value="U 19" {{ old('level') == 'U 19' ? 'selected' : '' }}>U 19</option>
                                    <option value="Other" {{ old('level') == 'Other' ? 'selected' : '' }}>Other</option>
                                </select>
                                @error('level')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Notes -->
                        <div>
                            <label for="note" class="block text-sm font-medium text-gray-700 mb-2">
                                Notes
                            </label>
                            <textarea name="note" id="note" rows="4"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent @error('note') border-red-500 @enderror"
                                placeholder="Additional information about the match...">{{ old('note') }}</textarea>
                            @error('note')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Form Actions -->
                        <div class="flex justify-end space-x-4 pt-6 border-t">
                            <a href="{{ route('matches.index') }}"
                                class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition">
                                Cancel
                            </a>
                            <button type="submit"
                                class="px-6 py-2 bg-teal-500 text-white rounded-lg hover:bg-teal-600 transition flex items-center">
                                <span class="material-icons mr-2 text-sm">save</span>
                                Add Match
                            </button>
                        </div>
                    </form>
                </div>
            </main>
        </div>
    </div>
</body>

</html>
