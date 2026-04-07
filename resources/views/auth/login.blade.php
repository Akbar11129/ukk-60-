@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-blue-50 to-indigo-100 py-12 px-4 sm:px-6 lg:px-8">
    <div class="w-full max-w-md space-y-8">
        <!-- Logo/Header -->
        <div class="text-center">
            <h2 class="text-3xl font-bold text-gray-900">{{ config('app.name', 'Laravel') }}</h2>
            <p class="mt-2 text-sm text-gray-600">Sistem Pengaduan & Aspirasi</p>
        </div>

        <!-- Login Card -->
        <div class="bg-white py-8 px-4 shadow-md rounded-lg sm:px-6">
            <!-- Tab Navigation -->
            <div class="mb-6">
                <div class="flex space-x-1 rounded-lg bg-gray-100 p-1">
                    <button type="button"
                            onclick="switchTab('admin')"
                            id="admin-tab"
                            class="admin-tab flex-1 py-2 px-3 rounded-md font-medium text-sm transition-colors duration-200 bg-white text-gray-900 shadow-sm">
                        Login Admin
                    </button>
                    <button type="button"
                            onclick="switchTab('siswa')"
                            id="siswa-tab"
                            class="siswa-tab flex-1 py-2 px-3 rounded-md font-medium text-sm transition-colors duration-200 text-gray-600 hover:text-gray-900">
                        Login Siswa
                    </button>
                </div>
            </div>

            <!-- Error Messages -->
            @if ($errors->any())
                <div class="mb-4 p-4 bg-red-50 border border-red-200 rounded-lg">
                    <p class="text-sm font-medium text-red-800">{{ __('Whoops! Something went wrong.') }}</p>
                    <ul class="mt-2 list-disc list-inside text-sm text-red-700">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Login Form -->
            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf

                <!-- Hidden user_type field -->
                <input type="hidden" name="user_type" id="user_type" value="admin">

                <!-- Admin Login Fields -->
                <div id="admin-form" class="admin-form space-y-4">
                    <!-- Username -->
                    <div>
                        <label for="username" class="block text-sm font-medium text-gray-700">
                            Username
                        </label>
                        <input id="username"
                               class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 @error('username') border-red-500 @enderror"
                               type="text"
                               name="username"
                               value="{{ old('username') }}"
                               autocomplete="username"
                               autofocus
                               required>
                        @error('username')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Siswa Login Fields -->
                <div id="siswa-form" class="siswa-form space-y-4 hidden">
                    <!-- NIS -->
                    <div>
                        <label for="nis" class="block text-sm font-medium text-gray-700">
                            NIS (Nomor Induk Siswa)
                        </label>
                        <input id="nis"
                               class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 @error('nis') border-red-500 @enderror"
                               type="text"
                               name="nis"
                               value="{{ old('nis') }}"
                               autocomplete="username">
                        @error('nis')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Password (Common) -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">
                        Password
                    </label>
                    <input id="password"
                           class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 @error('password') border-red-500 @enderror"
                           type="password"
                           name="password"
                           autocomplete="current-password"
                           required>
                    @error('password')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Remember Me -->
                <div class="flex items-center">
                    <input id="remember_me"
                           type="checkbox"
                           name="remember"
                           class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded cursor-pointer">
                    <label for="remember_me" class="ml-2 block text-sm text-gray-700">
                        Ingat saya
                    </label>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors duration-200">
                    Masuk
                </button>
            </form>
        </div>

        <!-- Footer -->
        <p class="text-center text-sm text-gray-600">
            Butuh bantuan?
            <a href="#" class="font-medium text-indigo-600 hover:text-indigo-500">Hubungi admin</a>
        </p>
    </div>
</div>

<script>
    function switchTab(type) {
        // Update hidden input
        document.getElementById('user_type').value = type;

        // Update tab styles
        const adminTab = document.getElementById('admin-tab');
        const siswaTab = document.getElementById('siswa-tab');

        if (type === 'admin') {
            adminTab.classList.add('bg-white', 'text-gray-900', 'shadow-sm');
            adminTab.classList.remove('text-gray-600', 'hover:text-gray-900');

            siswaTab.classList.remove('bg-white', 'text-gray-900', 'shadow-sm');
            siswaTab.classList.add('text-gray-600', 'hover:text-gray-900');
        } else {
            siswaTab.classList.add('bg-white', 'text-gray-900', 'shadow-sm');
            siswaTab.classList.remove('text-gray-600', 'hover:text-gray-900');

            adminTab.classList.remove('bg-white', 'text-gray-900', 'shadow-sm');
            adminTab.classList.add('text-gray-600', 'hover:text-gray-900');
        }

        // Toggle form visibility
        const adminForm = document.getElementById('admin-form');
        const siswaForm = document.getElementById('siswa-form');

        if (type === 'admin') {
            adminForm.classList.remove('hidden');
            siswaForm.classList.add('hidden');
            document.getElementById('username').focus();
        } else {
            siswaForm.classList.remove('hidden');
            adminForm.classList.add('hidden');
            document.getElementById('nis').focus();
        }
    }

    // Initialize based on old input
    @if (old('user_type') === 'siswa')
        switchTab('siswa');
    @endif
</script>
@endsection
