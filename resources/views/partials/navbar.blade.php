<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="{{ route('dashboard') }}">Mini CRM</a>

        <div class="ml-auto">
            @auth
                <span class="mr-3">مرحبًا {{ auth()->user()->name }}</span>
                <form method="POST" action="{{ route('logout') }}" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-sm btn-danger">تسجيل الخروج</button>
                </form>
            @endauth
        </div>
    </div>
</nav>
