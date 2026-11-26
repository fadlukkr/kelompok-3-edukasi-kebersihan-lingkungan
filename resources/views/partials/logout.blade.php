<form action="{{ route('logout') }}" method="POST" class="logout-form">
    @csrf
    <button type="submit" class="logout-btn">
        Logout
    </button>
</form>
