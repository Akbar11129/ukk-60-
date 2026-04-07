<!-- Logout Button (gunakan di dashboard/navbar) -->

<form method="POST" action="{{ route('logout') }}" style="display: inline;">
    @csrf
    <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 text-white font-medium rounded-lg hover:bg-red-700 transition-colors duration-200">
        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
        </svg>
        Logout
    </button>
</form>

<!-- Alternative: Tailwind button style -->
<button onclick="document.getElementById('logout-form').submit()" class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">
    Logout
</button>

<form id="logout-form" method="POST" action="{{ route('logout') }}" style="display: none;">
    @csrf
</form>

<!-- Check current user (di controller atau blade) -->
@if(Auth::guard('admin')->check())
    <p>Logged in as Admin: {{ Auth::guard('admin')->user()->username }}</p>
@elseif(Auth::guard('siswa')->check())
    <p>Logged in as Siswa: {{ Auth::guard('siswa')->user()->nama }}</p>
@else
    <p>Not logged in</p>
@endif
