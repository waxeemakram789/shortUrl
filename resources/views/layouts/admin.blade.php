<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Admin Panel</title>
    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">ShortURL Admin</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Dashboard</a>
                    </li>
                    @if (auth()->user()->isSuperAdmin() || auth()->user()->isAdmin())
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('invite.index') }}">Invite</a>
                        </li>
                    @endif
                     @if (auth()->user()->isAdmin() || auth()->user()->isMember() || auth()->user()->isSuperAdmin() )
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('shorturls.*') ? 'active' : '' }}"
                                href="{{ route('shorturls.index') }}">
                                Short URLs
                            </a>
                        </li>
                    @endif
                </ul>
                


                <ul class="navbar-nav">
                    <li class="nav-item">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="btn btn-outline-light btn-sm" type="submit">Logout</button>
                        </form>
                    </li>
                </ul>
               
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        @yield('content')
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
