<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="{{ $theme_preference ?? 'light' }}"> {{-- Tambahkan data-theme --}}

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Manage News')</title>

    {{-- Masukkan CSS Bootstrap Anda di sini --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    {{-- CSS Kustom Anda --}}
    <link rel="stylesheet" href="{{ asset('css/app.css') }}"> {{-- Pastikan Anda punya file ini --}}
    {{-- Tambahkan file CSS untuk tema gelap --}}
    <link rel="stylesheet" href="{{ asset('css/dark-theme.css') }}">

    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <ul class="navbar-nav ms-auto">
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <div class="dropdown" style="position: relative; display: inline-block;">
                                <a href="#" id="userDropdownLink" class="nav-link"
                                    style="font-weight: 600; transition: color 0.2s; display: flex; align-items: center;" {{-- Added display:flex for alignment --}}
                                    aria-haspopup="true" aria-expanded="false"> {{-- Added ARIA attributes for accessibility --}}
                                    
                                    {{-- Foto Profil atau Ikon Default --}}
                                    @if(Auth::user()->profile_picture)
                                        <img src="{{ asset('storage/' . Auth::user()->profile_picture) }}"
                                             alt="Foto Profil {{ Auth::user()->name }}"
                                             style="width: 32px; height: 32px; border-radius: 50%; object-fit: cover; margin-right: 8px;">
                                    @else
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16" style="margin-right: 8px;">
                                            <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
                                            <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 1.37A7 7 0 0 0 8 1"/>
                                        </svg>
                                    @endif

                                    {{ Auth::user()->name }}
                                    <span id="dropdownArrow" style="display: inline-block; transition: transform 0.3s; margin-left: 5px;"> {{-- Added margin-left --}}
                                        &#9662;
                                    </span>
                                </a>
                                <div class="dropdown-menu" id="userDropdownMenu"
                                    style="display: none; opacity: 0; position: fixed; right: 20px; top: 60px; background: #fff; border: 1px solid #ccc; min-width: 180px; z-index: 9999; box-shadow: 0 2px 16px rgba(0,0,0,0.18); border-radius: 8px; transition: opacity 0.3s, transform 0.3s; transform: translateY(10px);">
                                    
                                    <a class="dropdown-item" href="{{ route('profile.show') ?? '#' }}" {{-- Added fallback # route --}}
                                       style="display: flex; align-items: center; padding: 10px 15px; font-weight: 600; color: #333; border-bottom: 1px solid #eee;">
                                        @if(Auth::user()->profile_picture)
                                            <img src="{{ asset('storage/' . Auth::user()->profile_picture) }}"
                                                 alt="Foto Profil {{ Auth::user()->name }}"
                                                 style="width: 40px; height: 40px; border-radius: 50%; object-fit: cover; margin-right: 10px;">
                                        @else
                                            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16" style="margin-right: 10px;">
                                                <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
                                                <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 1.37A7 7 0 0 0 8 1"/>
                                            </svg>
                                        @endif
                                        <span>Profil Saya</span>
                                    </a>

                                    <a class="dropdown-item" href="{{ route('settings.index') ?? '#' }}" style="padding: 8px 15px;"> {{-- Added fallback # route --}}
                                        Pengaturan
                                    </a>
                                    
                                    <div class="dropdown-divider" style="border-top: 1px solid #eee; margin: 5px 0;"></div>

                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();" style="padding: 8px 15px;">
                                        {{ __('Logout') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </div>
                            <script>
                                document.addEventListener('DOMContentLoaded', function() {
                                    var link = document.getElementById('userDropdownLink');
                                    var menu = document.getElementById('userDropdownMenu');
                                    var arrow = document.getElementById('dropdownArrow');

                                    if (link && menu && arrow) {
                                        link.addEventListener('click', function(e) {
                                            e.preventDefault();
                                            const isExpanded = link.getAttribute('aria-expanded') === 'true';

                                            if (isExpanded) {
                                                menu.style.opacity = '0';
                                                menu.style.transform = 'translateY(10px)';
                                                arrow.style.transform = 'rotate(0deg)';
                                                link.setAttribute('aria-expanded', 'false');
                                                setTimeout(function() {
                                                    menu.style.display = 'none';
                                                }, 300);
                                            } else {
                                                menu.style.display = 'block';
                                                setTimeout(function() {
                                                    menu.style.opacity = '1';
                                                    menu.style.transform = 'translateY(0)';
                                                    arrow.style.transform = 'rotate(180deg)';
                                                    link.setAttribute('aria-expanded', 'true');
                                                }, 10);
                                            }
                                        });

                                        document.addEventListener('click', function(e) {
                                            if (!link.contains(e.target) && !menu.contains(e.target)) {
                                                if (link.getAttribute('aria-expanded') === 'true') {
                                                    menu.style.opacity = '0';
                                                    menu.style.transform = 'translateY(10px)';
                                                    arrow.style.transform = 'rotate(0deg)';
                                                    link.setAttribute('aria-expanded', 'false');
                                                    setTimeout(function() {
                                                        menu.style.display = 'none';
                                                    }, 300);
                                                }
                                            }
                                        });
                                    }
                                });
                            </script>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>

    {{-- JavaScript Bootstrap (Bundle) --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    {{-- Untuk skrip dari view lain (misal settings.index) --}}
    @stack('scripts')
</body>

</html>
