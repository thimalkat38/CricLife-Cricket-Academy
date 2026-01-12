<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>CricLife Cricket Academy - Edit Coach</title>
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
                        <a href="{{ route('admin.dashboard') }}"
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
                                <a href="{{ route('admin.players.create') }}"
                                    class="flex items-center px-6 py-3 text-gray-300 hover:bg-slate-800 hover:text-white transition">
                                    <span class="material-icons mr-3">person_add</span>
                                    Add Player
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.players.index') }}"
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
                                <a href="{{ route('admin.coaches.create') }}"
                                    class="flex items-center px-6 py-3 text-gray-300 hover:bg-slate-800 hover:text-white transition">
                                    <span class="material-icons mr-3">person_add</span>
                                    Add Coach
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.coaches.index') }}"
                                    class="flex items-center px-6 py-3 text-teal-500 font-semibold bg-slate-800 rounded-l-full">
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
                                <a href="{{ route('admin.matches.create') }}"
                                    class="flex items-center px-6 py-3 text-gray-300 hover:bg-slate-800 hover:text-white transition">
                                    <span class="material-icons mr-3">add</span>
                                    Add Match
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.matches.index') }}"
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
                        <span class="material-icons text-gray-400">edit</span>
                        <span class="text-xl font-semibold font-poppins text-gray-900">Edit Coach</span>
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
                        <span class="material-icons mr-2 text-teal-500">edit</span>
                        Edit Coach Information
                    </h2>

                    <form method="POST" action="{{ route('admin.coaches.update', $coach) }}" enctype="multipart/form-data" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <!-- Coach Basic Information -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Coach Name -->
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                                    Coach Name <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="name" id="name" value="{{ old('name', $coach->name) }}"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent @error('name') border-red-500 @enderror"
                                    required>
                                @error('name')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Role -->
                            <div>
                                <label for="role" class="block text-sm font-medium text-gray-700 mb-2">
                                    Role <span class="text-red-500">*</span>
                                </label>
                                <select name="role" id="role"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent @error('role') border-red-500 @enderror"
                                    required>
                                    <option value="">Select Role</option>
                                    <option value="Head Coach" {{ old('role', $coach->role) == 'Head Coach' ? 'selected' : '' }}>Head Coach</option>
                                    <option value="Assistant Coach" {{ old('role', $coach->role) == 'Assistant Coach' ? 'selected' : '' }}>Assistant Coach</option>
                                    <option value="Sub Assistant Coach" {{ old('role', $coach->role) == 'Sub Assistant Coach' ? 'selected' : '' }}>Sub Assistant Coach</option>
                                    <option value="Thrower" {{ old('role', $coach->role) == 'Thrower' ? 'selected' : '' }}>Thrower</option>
                                </select>
                                @error('role')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Gender -->
                            <div>
                                <label for="gender" class="block text-sm font-medium text-gray-700 mb-2">
                                    Gender <span class="text-red-500">*</span>
                                </label>
                                <select name="gender" id="gender"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent @error('gender') border-red-500 @enderror"
                                    required>
                                    <option value="">Select Gender</option>
                                    <option value="Male" {{ old('gender', $coach->gender) == 'Male' ? 'selected' : '' }}>Male</option>
                                    <option value="Female" {{ old('gender', $coach->gender) == 'Female' ? 'selected' : '' }}>Female</option>
                                    <option value="Other" {{ old('gender', $coach->gender) == 'Other' ? 'selected' : '' }}>Other</option>
                                </select>
                                @error('gender')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- NIC -->
                            <div>
                                <label for="nic" class="block text-sm font-medium text-gray-700 mb-2">
                                    NIC Number
                                </label>
                                <input type="text" name="nic" id="nic" value="{{ old('nic', $coach->nic) }}"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent @error('nic') border-red-500 @enderror">
                                @error('nic')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Phone Number -->
                            <div>
                                <label for="num" class="block text-sm font-medium text-gray-700 mb-2">
                                    Phone Number
                                </label>
                                <input type="text" name="num" id="num" value="{{ old('num', $coach->num) }}"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent @error('num') border-red-500 @enderror">
                                @error('num')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Qualifications -->
                        <div>
                            <label for="qualifications" class="block text-sm font-medium text-gray-700 mb-2">
                                Qualifications
                            </label>
                            <textarea name="qualifications" id="qualifications" rows="3"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent @error('qualifications') border-red-500 @enderror"
                                placeholder="e.g., Level 2 Cricket Coaching Certificate, BSc Sports Science">{{ old('qualifications', $coach->qualifications) }}</textarea>
                            @error('qualifications')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Address -->
                        <div>
                            <label for="address" class="block text-sm font-medium text-gray-700 mb-2">
                                Address
                            </label>
                            <textarea name="address" id="address" rows="3"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent @error('address') border-red-500 @enderror">{{ old('address', $coach->address) }}</textarea>
                            @error('address')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Additional Information -->
                        <div class="border-t pt-6 mt-6">
                            <h3 class="text-xl font-semibold text-gray-800 mb-4 flex items-center">
                                <span class="material-icons mr-2 text-teal-500">info</span>
                                Additional Information
                            </h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Salary -->
                                <div>
                                    <label for="salary" class="block text-sm font-medium text-gray-700 mb-2">
                                        Salary
                                    </label>
                                    <input type="text" name="salary" id="salary" value="{{ old('salary', $coach->salary) }}"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent @error('salary') border-red-500 @enderror"
                                        placeholder="e.g., 50000">
                                    @error('salary')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Photo -->
                                <div>
                                    <label for="photo" class="block text-sm font-medium text-gray-700 mb-2">
                                        Photo
                                    </label>
                                    @if ($coach->photo_url)
                                        <div class="mb-2">
                                            <img src="{{ $coach->photo_url }}" alt="{{ $coach->name }}"
                                                class="h-20 w-20 rounded-lg object-cover border border-gray-300"
                                                onerror="this.style.display='none'; this.nextElementSibling.style.display='block';">
                                            <p class="text-xs text-gray-500 mt-1" style="display:none;">Image not found</p>
                                            <p class="text-xs text-gray-500 mt-1">Current photo</p>
                                        </div>
                                    @elseif ($coach->photo)
                                        <div class="mb-2">
                                            <div class="h-20 w-20 rounded-lg bg-gray-200 flex items-center justify-center border border-gray-300">
                                                <span class="material-icons text-gray-400">broken_image</span>
                                            </div>
                                            <p class="text-xs text-red-500 mt-1">Image file not found. Please upload a new photo.</p>
                                        </div>
                                    @endif
                                    <input type="file" name="photo" id="photo" accept="image/*"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent @error('photo') border-red-500 @enderror">
                                    @error('photo')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                    <p class="mt-1 text-sm text-gray-500">Max file size: 2MB. Allowed formats: JPEG, PNG, JPG, GIF</p>
                                </div>
                            </div>
                        </div>

                        <!-- Form Actions -->
                        <div class="flex justify-end space-x-4 pt-6 border-t">
                            <a href="{{ route('admin.coaches.index') }}"
                                class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition">
                                Cancel
                            </a>
                            <button type="submit"
                                class="px-6 py-2 bg-teal-500 text-white rounded-lg hover:bg-teal-600 transition flex items-center">
                                <span class="material-icons mr-2 text-sm">save</span>
                                Update Coach
                            </button>
                        </div>
                    </form>
                </div>
            </main>
        </div>
    </div>
</body>

</html>
