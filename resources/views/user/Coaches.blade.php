<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>CricLife Cricket Academy - All Coaches</title>
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
                            class="flex items-center px-6 py-3 text-gray-300 hover:bg-slate-800 hover:text-white transition">
                            <span class="material-icons mr-3">sports_cricket</span>
                            Players
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('user.coaches.index') }}"
                            class="flex items-center px-6 py-3 text-teal-500 font-semibold bg-slate-800 rounded-l-full">
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
                        <span class="text-xl font-semibold font-poppins text-gray-900">All Coaches</span>
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
                        <span class="material-icons mr-2 text-teal-500">person</span>
                        Coaches List
                    </h2>
                </div>

                <!-- Coaches Table -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    @if ($coaches->count() > 0)
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
                                            Coach Name
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Role of Coach
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Gender
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            NIC
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Phone
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Qualifications
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Salary
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Actions
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach ($coaches as $index => $coach)
                                        <tr class="hover:bg-gray-50 transition">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{ $coaches->firstItem() + $index }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                @if ($coach->photo_url)
                                                    <img src="{{ $coach->photo_url }}" alt="{{ $coach->name }}"
                                                        class="h-12 w-12 rounded-full object-cover border border-gray-200"
                                                        onerror="this.onerror=null; this.parentElement.innerHTML='<div class=\'h-12 w-12 rounded-full bg-gray-200 flex items-center justify-center\'><span class=\'material-icons text-gray-400\'>person</span></div>';">
                                                @else
                                                    <div class="h-12 w-12 rounded-full bg-gray-200 flex items-center justify-center">
                                                        <span class="material-icons text-gray-400">person</span>
                                                    </div>
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm font-medium text-gray-900">{{ $coach->name }}</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                {{ $coach->role ?? 'N/A' }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span
                                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                                    {{ $coach->gender == 'Male' ? 'bg-blue-100 text-blue-800' : ($coach->gender == 'Female' ? 'bg-pink-100 text-pink-800' : 'bg-gray-100 text-gray-800') }}">
                                                    {{ $coach->gender ?? 'N/A' }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{ $coach->nic ?? 'N/A' }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{ $coach->num ?? 'N/A' }}
                                            </td>
                                            <td class="px-6 py-4 text-sm text-gray-500">
                                                <div class="max-w-xs truncate" title="{{ $coach->qualifications ?? 'N/A' }}">
                                                    {{ $coach->qualifications ?? 'N/A' }}
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{ $coach->salary ? 'Rs. ' . $coach->salary : 'N/A' }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                <a href="{{ route('user.coaches.show', $coach) }}"
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
                            {{ $coaches->links() }}
                        </div>
                    @else
                        <div class="text-center py-12">
                            <span class="material-icons text-gray-400 text-6xl mb-4">person</span>
                            <h3 class="text-lg font-medium text-gray-900 mb-2">No coaches found</h3>
                            <p class="text-gray-500">There are no coaches in the system.</p>
                        </div>
                    @endif
                </div>
            </main>
        </div>
    </div>
</body>

</html>
