<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">


    <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
    <script type="text/javascript" src="{{ asset('js/sidebar.js') }}" defer></script>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <!-- CSS Internal -->
    <style>
        body {
            min-height: 100vh;
            min-height: 100dvh;
            /* background-color: var(--base-clr); */
            color: var(--base-clr);
            display: grid;
            grid-template-columns: auto 1fr;
        }

        /* Terapkan font Poppins secara global */
        body {
            font-family: 'Poppins', sans-serif;
        }

        /* Sesuaikan font untuk elemen tertentu jika diperlukan */
        .logo {
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
            /* Contoh penerapan font dengan berat khusus */
        }

        ul li a,
        .sub-menu li a {
            font-family: 'Poppins', sans-serif;
            font-weight: 400;
            /* Berat reguler untuk teks menu */
        }

        /* Terapkan pada tombol dan teks lain */
        button,
        .btn {
            font-family: 'Poppins', sans-serif;
            font-weight: 500;
        }

        .dropdown-btn span,
        .dropdown-btn svg {
            font-family: 'Poppins', sans-serif;
            font-weight: 500;
        }
    </style>


    @yield('styles')
</head>

<body>
    <!-- Sidebar -->
    <nav id="sidebar">
        <ul>
            <li>
                <span class="logo">SIMGANG</span>
                <button onclick="toggleSidebar()" id="toggle-btn">
                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px"
                        fill="#e8eaed">
                        <path
                            d="m313-480 155 156q11 11 11.5 27.5T468-268q-11 11-28 11t-28-11L228-452q-6-6-8.5-13t-2.5-15q0-8 2.5-15t8.5-13l184-184q11-11 27.5-11.5T468-692q11 11 11 28t-11 28L313-480Zm264 0 155 156q11 11 11.5 27.5T732-268q-11 11-28 11t-28-11L492-452q-6-6-8.5-13t-2.5-15q0-8 2.5-15t8.5-13l184-184q11-11 27.5-11.5T732-692q11 11 11 28t-11 28L577-480Z" />
                    </svg>
                </button>
            </li>


            <!-- Checking user role -->
            @if (Auth::check() && Auth::user()->role == 'siswa')
                <!-- Sidebar for 'siswa' -->
                <li class="{{ request()->routeIs('siswa.dashboard') ? 'active' : '' }}">
                    <a href="{{ route('siswa.dashboard') }}">
                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px"
                            fill="#e8eaed">
                            <path
                                d="M520-640v-160q0-17 11.5-28.5T560-840h240q17 0 28.5 11.5T840-800v160q0 17-11.5 28.5T800-600H560q-17 0-28.5-11.5T520-640ZM120-480v-320q0-17 11.5-28.5T160-840h240q17 0 28.5 11.5T440-800v320q0 17-11.5 28.5T400-440H160q-17 0-28.5-11.5T120-480Zm400 320v-320q0-17 11.5-28.5T560-520h240q17 0 28.5 11.5T840-480v320q0 17-11.5 28.5T800-120H560q-17 0-28.5-11.5T520-160Zm-400 0v-160q0-17 11.5-28.5T160-360h240q17 0 28.5 11.5T440-320v160q0 17-11.5 28.5T400-120H160q-17 0-28.5-11.5T120-160Zm80-360h160v-240H200v240Zm400 320h160v-240H600v240Zm0-480h160v-80H600v80ZM200-200h160v-80H200v80Zm160-320Zm240-160Zm0 240ZM360-280Z" />
                        </svg>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li>
                    @if($sertifikat)
                    <a href="{{ route('siswa.nilai',['id_sertifikat' => $sertifikat->id_sertifikat]) }}">
                        <svg id="Layer_1" height="24px" viewBox="0 0 24 24" width="24px"
                            xmlns="http://www.w3.org/2000/svg" data-name="Layer 1">
                            <path
                                d="m19.828 3.414-2.242-2.242a4.024 4.024 0 0 0 -2.828-1.172h-8.758a3 3 0 0 0 -3 3v21h18v-17.758a4.024 4.024 0 0 0 -1.172-2.828zm-1.414 1.414a2.113 2.113 0 0 1 .141.172h-2.555v-2.555a2.113 2.113 0 0 1 .172.141zm-13.414 17.172v-19a1 1 0 0 1 1-1h8v5h5v15zm9-5h3v2h-3zm1-2v-1.707a6.964 6.964 0 0 0 -.621-2.883l-.522-1.153a2 2 0 0 0 -3.7-.04l-.539 1.194a6.956 6.956 0 0 0 -.618 2.882v1.707h2v-1h2v1zm-2.982-4.959.539 1.192a4.949 4.949 0 0 1 .252.767h-1.618a4.9 4.9 0 0 1 .252-.766zm-.478 6 1.42 1.408-1.866 1.884a2.255 2.255 0 0 1 -3.185 0l-.873-.891 1.428-1.4.866.884a.249.249 0 0 0 .347-.007z" />
                        </svg>
                        <span>Nilai</span>
                    </a>
                    @else
                    <span>Nilai</span>
                    @endif
                </li>
            @elseif(Auth::check() && Auth::user()->role == 'mentor')
                <!-- Sidebar for 'mentor' -->
                <li>
                    <a href="{{ route('mentor.dashboard') }}">
                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px"
                            fill="#e8eaed">
                            <path
                                d="M520-640v-160q0-17 11.5-28.5T560-840h240q17 0 28.5 11.5T840-800v160q0 17-11.5 28.5T800-600H560q-17 0-28.5-11.5T520-640ZM120-480v-320q0-17 11.5-28.5T160-840h240q17 0 28.5 11.5T440-800v320q0 17-11.5 28.5T400-440H160q-17 0-28.5-11.5T120-480Zm400 320v-320q0-17 11.5-28.5T560-520h240q17 0 28.5 11.5T840-480v320q0 17-11.5 28.5T800-120H560q-17 0-28.5-11.5T520-160Zm-400 0v-160q0-17 11.5-28.5T160-360h240q17 0 28.5 11.5T440-320v160q0 17-11.5 28.5T400-120H160q-17 0-28.5-11.5T120-160Zm80-360h160v-240H200v240Zm400 320h160v-240H600v240Zm0-480h160v-80H600v80ZM200-200h160v-80H200v80Zm160-320Zm240-160Zm0 240ZM360-280Z" />
                        </svg>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="{{ request()->routeIs('mentor.dashboard') ? 'active' : '' }}"">
                    <button onclick="toggleSubMenu(this)" class="dropdown-btn">
                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px"
                            fill="#e8eaed">
                            <path
                                d="M160-160q-33 0-56.5-23.5T80-240v-480q0-33 23.5-56.5T160-800h207q16 0 30.5 6t25.5 17l57 57h320q33 0 56.5 23.5T880-640v400q0 33-23.5 56.5T800-160H160Zm0-80h640v-400H447l-80-80H160v480Zm400-160v-40q0-17 11.5-28.5T600-320q17 0 28.5-11.5T640-360v-40h40q17 0 28.5-11.5T720-440q0-17-11.5-28.5T680-480h-40v-40q0-17-11.5-28.5T600-560q-17 0-28.5 11.5T560-520v40h-40q-17 0-28.5 11.5T480-440q0 17 11.5 28.5T520-400h40Z" />
                        </svg>
                        <span>Create</span>
                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px"
                            fill="#e8eaed">
                            <path
                                d="M480-361q-8 0-15-2.5t-13-8.5L268-556q-11-11-11-28t11-28q11-11 28-11t28 11l156 156 156-156q11-11 28-11t28 11q11 11 11 28t-11 28L508-372q-6 6-13 8.5t-15 2.5Z" />
                        </svg>
                    </button>
                    <ul class="sub-menu">
                        <div>
                            <li><a href="{{ route('siswa.dashboard') }}">Siswa</a></li>
                            <li><a href="{{ route('user.index') }}">Pengguna</a></li>
                            <li><a href="{{ route('penilaian.index') }}">Penilaian</a></li>
                        </div>
                    </ul>
                </li>
            @endif

            <!-- User Authentication Links -->
            @guest
                <li>
                    <a href="{{ route('login') }}"">
                        <i class=" fas fa-sign-in-alt me-2"></i> Login
                    </a>
                </li>
            @else
                <li>
                    <button onclick="toggleSubMenu(this)" class="dropdown-btn">
                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px"
                            fill="#e8eaed">
                            <path
                                d="M480-480q-66 0-113-47t-47-113q0-66 47-113t113-47q66 0 113 47t47 113q0 66-47 113t-113 47ZM160-160v-112q0-34 17.5-62.5T224-378q62-31 126-46.5T480-440q66 0 130 15.5T736-378q29 15 46.5 43.5T800-272v112H160Zm80-80h480v-32q0-11-5.5-20T700-306q-54-27-109-40.5T480-360q-56 0-111 13.5T260-306q-9 5-14.5 14t-5.5 20v32Zm240-320q33 0 56.5-23.5T560-640q0-33-23.5-56.5T480-720q-33 0-56.5 23.5T400-640q0 33 23.5 56.5T480-560Zm0-80Zm0 400Z" />
                        </svg>
                        <span>{{ Auth::user()->username }}</span>
                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px"
                            fill="#e8eaed">
                            <path
                                d="M480-361q-8 0-15-2.5t-13-8.5L268-556q-11-11-11-28t11-28q11-11 28-11t28 11l156 156 156-156q11-11 28-11t28 11q11 11 11 28t-11 28L508-372q-6 6-13 8.5t-15 2.5Z" />
                        </svg>
                    </button>
                    <ul class="sub-menu">
                        <div>
                            <li>
                                <a href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                    style="display: none;">
                                    @csrf
                                </form>
                            </li>
                        </div>
                    </ul>
                </li>
            @endguest
        </ul>
    </nav>

    <!-- Main Content -->
    <div class="">
        @yield('content')
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>

</html>
