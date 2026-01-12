<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>CricLife Cricket Academy - Edit Player</title>
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
                        <span class="text-xl font-semibold font-poppins text-gray-900">Edit Player</span>
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
                        Edit Player Information
                    </h2>

                    <form method="POST" action="{{ route('players.update', $player) }}" enctype="multipart/form-data" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <!-- Player Basic Information -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Player Name -->
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                                    Player Name <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="name" id="name" value="{{ old('name', $player->name) }}"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent @error('name') border-red-500 @enderror"
                                    required>
                                @error('name')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Date of Birth -->
                            <div>
                                <label for="dob" class="block text-sm font-medium text-gray-700 mb-2">
                                    Date of Birth <span class="text-red-500">*</span>
                                </label>
                                <input type="date" name="dob" id="dob" value="{{ old('dob', $player->dob) }}"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent @error('dob') border-red-500 @enderror"
                                    required>
                                @error('dob')
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
                                    <option value="Male" {{ old('gender', $player->gender) == 'Male' ? 'selected' : '' }}>Male</option>
                                    <option value="Female" {{ old('gender', $player->gender) == 'Female' ? 'selected' : '' }}>Female</option>
                                    <option value="Other" {{ old('gender', $player->gender) == 'Other' ? 'selected' : '' }}>Other</option>
                                </select>
                                @error('gender')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>


                            <!-- School -->
                            <div>
                                <label for="school" class="block text-sm font-medium text-gray-700 mb-2">
                                    School
                                </label>
                                <input type="text" name="school" id="school" value="{{ old('school', $player->school) }}"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent @error('school') border-red-500 @enderror">
                                @error('school')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Address -->
                        <div>
                            <label for="address" class="block text-sm font-medium text-gray-700 mb-2">
                                Address
                            </label>
                            <textarea name="address" id="address" rows="3"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent @error('address') border-red-500 @enderror">{{ old('address', $player->address) }}</textarea>
                            @error('address')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Parent/Guardian Information -->
                        <div class="border-t pt-6 mt-6">
                            <h3 class="text-xl font-semibold text-gray-800 mb-4 flex items-center">
                                <span class="material-icons mr-2 text-teal-500">family_restroom</span>
                                Parent/Guardian Information
                            </h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Parent Name -->
                                <div>
                                    <label for="p_name" class="block text-sm font-medium text-gray-700 mb-2">
                                        Parent/Guardian Name <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" name="p_name" id="p_name" value="{{ old('p_name', $player->p_name) }}"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent @error('p_name') border-red-500 @enderror"
                                        required>
                                    @error('p_name')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Parent Phone Number -->
                                <div>
                                    <label for="p_num" class="block text-sm font-medium text-gray-700 mb-2">
                                        Parent/Guardian Phone Number <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" name="p_num" id="p_num" value="{{ old('p_num', $player->p_num) }}"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent @error('p_num') border-red-500 @enderror"
                                        required>
                                    @error('p_num')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Additional Information -->
                        <div class="border-t pt-6 mt-6">
                            <h3 class="text-xl font-semibold text-gray-800 mb-4 flex items-center">
                                <span class="material-icons mr-2 text-teal-500">info</span>
                                Additional Information
                            </h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Player Phone Number -->
                                <div>
                                    <label for="num" class="block text-sm font-medium text-gray-700 mb-2">
                                        Player Phone Number
                                    </label>
                                    <input type="text" name="num" id="num" value="{{ old('num', $player->num) }}"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent @error('num') border-red-500 @enderror">
                                    @error('num')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Monthly Fee -->
                                <div>
                                    <label for="monthly_fee" class="block text-sm font-medium text-gray-700 mb-2">
                                        Monthly Fee
                                    </label>
                                    <input type="text" name="monthly_fee" id="monthly_fee" value="{{ old('monthly_fee', $player->monthly_fee) }}"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent @error('monthly_fee') border-red-500 @enderror"
                                        placeholder="e.g., 5000">
                                    @error('monthly_fee')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Photo -->
                                <div>
                                    <label for="photo" class="block text-sm font-medium text-gray-700 mb-2">
                                        Photo
                                    </label>
                                    @if ($player->photo_url)
                                        <div class="mb-2">
                                            <img src="{{ $player->photo_url }}" alt="{{ $player->name }}"
                                                class="h-20 w-20 rounded-lg object-cover border border-gray-300"
                                                onerror="this.style.display='none'; this.nextElementSibling.style.display='block';">
                                            <p class="text-xs text-gray-500 mt-1" style="display:none;">Image not found</p>
                                            <p class="text-xs text-gray-500 mt-1">Current photo</p>
                                        </div>
                                    @elseif ($player->photo)
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
                            <a href="{{ route('players.index') }}"
                                class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition">
                                Cancel
                            </a>
                            <button type="submit"
                                class="px-6 py-2 bg-teal-500 text-white rounded-lg hover:bg-teal-600 transition flex items-center">
                                <span class="material-icons mr-2 text-sm">save</span>
                                Update Player
                            </button>
                        </div>
                    </form>
                </div>
            </main>
        </div>
    </div>
</body>

</html>
