<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>CricLife Cricket Academy - All Players</title>
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
                        <a href="{{ route('user.dashboard') }}"
                            class="flex items-center px-6 py-3 text-gray-300 hover:bg-slate-800 hover:text-white transition">
                            <span class="material-icons mr-3">dashboard</span>
                            Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('user.players.index') }}"
                            class="flex items-center px-6 py-3 text-teal-500 font-semibold bg-slate-800 rounded-l-full">
                            <span class="material-icons mr-3">sports_cricket</span>
                            Players
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('user.coaches.index') }}"
                            class="flex items-center px-6 py-3 text-gray-300 hover:bg-slate-800 hover:text-white transition">
                            <span class="material-icons mr-3">person</span>
                            Coaches
                        </a>
                    </li>
                    <a href="{{ route('user.matches.index') }}"
                    class="flex items-center px-6 py-3 text-gray-300 hover:bg-slate-800 hover:text-white transition">
                    <span class="material-icons mr-3">sports</span>
                    Matches
                </a>
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
                        <span class="text-xl font-semibold font-poppins text-gray-900">All Players</span>
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
                <!-- Header Actions -->
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-semibold text-gray-800 flex items-center">
                        <span class="material-icons mr-2 text-teal-500">sports_cricket</span>
                        Players List
                    </h2>
                </div>

                <!-- Players Table -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    @if ($players->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            #
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Photo
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Player Name
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Date of Birth
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Gender
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            School
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Parent Name
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Parent Phone
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Monthly Fee
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Actions
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach ($players as $index => $player)
                                        <tr class="hover:bg-gray-50 transition">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{ $player->player_id ?? 'N/A' }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                @if ($player->photo_url)
                                                    <img src="{{ $player->photo_url }}" alt="{{ $player->name }}"
                                                        class="h-12 w-12 rounded-full object-cover border border-gray-200"
                                                        onerror="this.onerror=null; this.parentElement.innerHTML='<div class=\'h-12 w-12 rounded-full bg-gray-200 flex items-center justify-center\'><span class=\'material-icons text-gray-400\'>person</span></div>';">
                                                @else
                                                    <div class="h-12 w-12 rounded-full bg-gray-200 flex items-center justify-center">
                                                        <span class="material-icons text-gray-400">person</span>
                                                    </div>
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm font-medium text-gray-900">{{ $player->name }}</div>
                                                @if ($player->num)
                                                    <div class="text-sm text-gray-500">{{ $player->num }}</div>
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                @if ($player->dob)
                                                    {{ \Carbon\Carbon::parse($player->dob)->format('M d, Y') }}
                                                    @php
                                                        $age = \Carbon\Carbon::parse($player->dob)->age;
                                                    @endphp
                                                    ({{ $age }})
                                                @else
                                                    N/A
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span
                                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                                    {{ $player->gender == 'Male' ? 'bg-blue-100 text-blue-800' : ($player->gender == 'Female' ? 'bg-pink-100 text-pink-800' : 'bg-gray-100 text-gray-800') }}">
                                                    {{ $player->gender ?? 'N/A' }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 text-sm text-gray-500">
                                                {{ $player->school ?? 'N/A' }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{ $player->p_name }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{ $player->p_num }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{ $player->monthly_fee ? 'Rs. ' . $player->monthly_fee : 'N/A' }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                <a href="{{ route('user.players.show', $player) }}"
                                                    class="text-teal-600 hover:text-teal-900 transition"
                                                    title="View">
                                                    <span class="material-icons text-sm">visibility</span>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        <div class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6">
                            {{ $players->links() }}
                        </div>
                    @else
                        <div class="text-center py-12">
                            <span class="material-icons text-gray-400 text-6xl mb-4">sports_cricket</span>
                            <h3 class="text-lg font-medium text-gray-900 mb-2">No players found</h3>
                            <p class="text-gray-500">There are no players in the system.</p>
                        </div>
                    @endif
                </div>
            </main>
        </div>
    </div>
</body>

</html>
