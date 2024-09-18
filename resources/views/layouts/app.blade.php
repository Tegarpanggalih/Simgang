<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    @yield('styles')
</head>

<body>
    <div class="d-flex" style="height: 100vh;">
        <!-- Sidebar -->
        <nav class="bg-light text-dark p-3" id="sidebar" style="width: 250px;">
            <h4 class="text-center mb-4">Sertifikat PKL</h4>
            <ul class="nav flex-column">

                <!-- Checking user role -->
                @if(Auth::check() && Auth::user()->role == 'siswa')

                    <!-- Sidebar untuk 'siswa' -->
                    <li class="nav-item mb-3">
                        <a class="nav-link d-flex align-items-center" href="{{ route('siswa.showsiswa') }}" style="color: #000;">
                            <i class="fas fa-tachometer-alt me-2"></i> Dashboard
                        </a>
                    </li>

                @elseif(Auth::check() && Auth::user()->role == 'mentor')
                    <!-- Sidebar untuk 'mentor' -->
                    <li class="nav-item mb-3">
                        <a class="nav-link d-flex align-items-center" href="{{ route('siswa.showsiswa') }}" style="color: #000;">
                            <i class="fas fa-users me-2"></i> Siswa
                        </a>
                    </li>
                    <li class="nav-item mb-3">
                        <a class="nav-link d-flex align-items-center" href="{{ route('user.index') }}" style="color: #000;">
                            <i class="fas fa-user-cog me-2"></i> Pengguna
                        </a>
                    </li>
                @endif
            </ul>
            
            <!-- User Authentication Links -->
            <hr class="bg-secondary">
            <ul class="nav flex-column">
                @guest
                    <li class="nav-item mb-3">
                        <a class="nav-link d-flex align-items-center" href="{{ route('login') }}" style="color: #000;">
                            <i class="fas fa-sign-in-alt me-2"></i> Login
                        </a>
                    </li>
                @else
                    <li class="nav-item dropdown mb-3">
                        <a class="nav-link d-flex align-items-center" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="color: #000;">
                            <i class="fas fa-user me-2"></i> {{ Auth::user()->username }}
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button class="dropdown-item" type="submit">Logout</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @endguest
            </ul>
        </nav>

        <!-- Main Content -->
        <div class="container mt-4">
            @yield('content')
        </div>

        <!-- Bootstrap Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
        @yield('scripts')
</body>

</html>
