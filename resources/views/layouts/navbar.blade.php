<header class="bg-white shadow sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex justify-between items-center">
        {{-- Logo --}}
        <a href="{{ route('home') }}"
           class="text-2xl font-extrabold bg-gradient-to-r from-blue-600 to-purple-600 text-transparent bg-clip-text hover:from-pink-500 hover:to-yellow-500 transition duration-300">
            Inigadget
        </a>

        {{-- Desktop Navigation --}}
        <nav class="hidden md:flex items-center space-x-6 text-gray-700 font-medium">
            @php
                $navLinks = [
                    ['name' => 'Beranda', 'route' => 'home', 'url' => '/'],
                    ['name' => 'Produk', 'route' => 'products', 'url' => 'products'],
                    ['name' => 'Kategori', 'route' => 'categories', 'url' => 'categories'],
                    ['name' => 'Tentang', 'route' => 'about', 'url' => 'about'],
                ];
            @endphp

            @foreach ($navLinks as $link)
                <a href="{{ route($link['route']) }}"
                   class="px-3 py-2 rounded-lg transition duration-200
                   {{ request()->is($link['url']) || request()->is($link['url'].'/*') ? 'font-bold text-blue-600 bg-blue-50' : 'hover:bg-blue-100 hover:text-blue-600' }}">
                    {{ $link['name'] }}
                </a>
            @endforeach
        </nav>

        {{-- Desktop Right --}}
        <div class="hidden md:flex items-center space-x-4">
            @if (session('customer'))
                {{-- Cart Icon --}}
                <a href="{{ route('cart.index') }}" class="relative text-gray-600 hover:text-blue-600 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    @if(session('cart') && count(session('cart')) > 0)
                        <span class="absolute -top-2 -right-3 bg-red-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center font-bold">
                            {{ count(session('cart')) }}
                        </span>
                    @endif
                </a>

                {{-- User Dropdown --}}
                <div class="relative">
                    <button id="userDropdownButton" class="flex items-center space-x-2 px-3 py-2 rounded-lg hover:bg-blue-50 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M5.121 17.804A4.992 4.992 0 0112 15a4.992 4.992 0 016.879 2.804M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        <span class="text-sm font-semibold text-gray-700">{{ Str::limit(session('customer')->name, 10) }}</span>
                        <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5.5 7l4.5 4.5L14.5 7H5.5z" clip-rule="evenodd"/>
                        </svg>
                    </button>
                    <div id="userDropdownMenu" class="hidden absolute right-0 mt-2 w-40 bg-white border rounded shadow-lg z-50">
                        <form action="{{ route('customer.logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-100">Logout</button>
                        </form>
                    </div>
                </div>
            @else
                <a href="{{ route('customer.login') }}"
                   class="px-4 py-2 text-sm font-semibold text-blue-600 border border-blue-600 rounded hover:bg-blue-600 hover:text-white transition">Login</a>
                <a href="{{ route('customer.register') }}"
                   class="px-4 py-2 text-sm font-semibold text-white bg-blue-600 rounded hover:bg-blue-700 transition">Register</a>
            @endif
        </div>

        {{-- Mobile Button --}}
        <button class="md:hidden text-gray-700 focus:outline-none" id="mobile-menu-toggle" aria-controls="mobile-menu" aria-expanded="false">
            <svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>
    </div>

    {{-- Mobile Menu --}}
    <div id="mobile-menu" class="md:hidden bg-white border-t overflow-hidden transition-all duration-300 ease-in-out max-h-0 opacity-0">
        <div class="px-4 pb-4 space-y-1">
            @foreach ($navLinks as $link)
                <a href="{{ route($link['route']) }}"
                   class="block py-2 px-3 rounded-lg transition hover:bg-blue-100 hover:text-blue-700
                   {{ request()->is($link['url']) ? 'font-bold text-blue-600 bg-blue-50' : '' }}">
                    {{ $link['name'] }}
                </a>
            @endforeach

            <div class="border-t pt-4 mt-2 space-y-2">
                @if (session('customer'))
                    <a href="{{ route('cart.index') }}"
                       class="flex justify-between items-center py-2 px-3 rounded-lg transition hover:bg-blue-100 hover:text-blue-700">
                        <span>Keranjang Belanja</span>
                        @if(session('cart') && count(session('cart')) > 0)
                            <span class="bg-red-500 text-white text-xs font-bold rounded-full w-6 h-6 flex items-center justify-center">
                                {{ count(session('cart')) }}
                            </span>
                        @endif
                    </a>
                    <div class="flex justify-between items-center px-3 py-2">
                        <div>
                            <div class="font-medium text-base text-gray-800">{{ session('customer')->name }}</div>
                            <div class="font-medium text-sm text-gray-500">{{ session('customer')->email }}</div>
                        </div>
                        <div>
                            <form action="{{ route('customer.logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="px-3 py-1 text-sm text-red-600 border border-red-500 rounded-md hover:bg-red-500 hover:text-white transition">
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <a href="{{ route('customer.login') }}" class="block w-full text-center px-4 py-2 border border-blue-600 text-blue-600 rounded hover:bg-blue-600 hover:text-white transition">Login</a>
                    <a href="{{ route('customer.register') }}" class="block w-full text-center px-4 py-2 mt-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">Register</a>
                @endif
            </div>
        </div>
    </div>

    {{-- Scripts --}}
    <script>
        const mobileMenuToggle = document.getElementById('mobile-menu-toggle');
        const mobileMenu = document.getElementById('mobile-menu');
        const dropdownBtn = document.getElementById('userDropdownButton');
        const dropdownMenu = document.getElementById('userDropdownMenu');

        if (mobileMenuToggle) {
            mobileMenuToggle.addEventListener('click', function () {
                const isOpen = mobileMenu.classList.contains('max-h-screen');

                if (isOpen) {
                    mobileMenu.classList.remove('max-h-screen', 'opacity-100', 'py-4');
                    mobileMenu.classList.add('max-h-0', 'opacity-0');
                } else {
                    mobileMenu.classList.remove('max-h-0', 'opacity-0');
                    mobileMenu.classList.add('max-h-screen', 'opacity-100', 'py-4');
                }
            });
        }

        if (dropdownBtn) {
            dropdownBtn.addEventListener('click', function (e) {
                e.stopPropagation();
                dropdownMenu.classList.toggle('hidden');
            });
        }

        document.addEventListener('click', function (e) {
            if (dropdownMenu && !dropdownMenu.classList.contains('hidden')) {
                if (!dropdownBtn.contains(e.target)) {
                    dropdownMenu.classList.add('hidden');
                }
            }
        });
    </script>
</header>
