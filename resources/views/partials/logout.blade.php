<form action="{{ route('logout') }}" method="POST" style="display:inline;">
    @csrf
    <button type="submit" style="background:white;color:#2e7d32;border:none;padding:8px 16px;border-radius:6px;cursor:pointer;font-weight:bold;">
        Logout
    </button>
</form>