<nav class="bg-white dark:bg-gray-900 border-b border-gray-200 dark:border-gray-700 shadow">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">
            <div class="flex items-center space-x-8">
                <a href="{{ route('dashboard') }}">
                    <x-application-logo class="h-8 w-auto text-gray-800 dark:text-white" />
                </a>

                <div class="hidden sm:flex space-x-6">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">Dashboard</x-nav-link>
                    <x-nav-link :href="route('loan.create')" :active="request()->routeIs('loan.create')">Peminjaman</x-nav-link>
                    <x-nav-link :href="route('loan.history')" :active="request()->routeIs('loan.history')">Riwayat</x-nav-link>
                </div>
            </div>

            <div class="flex items-center space-x-4">
                <span class="hidden sm:inline-block text-sm text-gray-600 dark:text-gray-300 font-semibold">
                    {{ Auth::user()->name }}
                </span>

                <a href="{{ route('profile.edit') }}" class="text-sm px-3 py-1 rounded bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-200 hover:bg-gray-200 dark:hover:bg-gray-600 transition">
                    Profile
                </a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-sm px-3 py-1 rounded bg-red-500 text-white hover:bg-red-600 transition">
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>
