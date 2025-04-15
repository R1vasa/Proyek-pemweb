<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
    @vite('resources/css/app.css')
    <title>Document</title>
</head>

<body>
    <nav class="flex justify-between items-center bg-slate-900 text-white px-7 lg:px-20 h-12 sticky top-0 z-50">
        <div>
            <img class="h-[35px]" src="https://tailwindcss.com/plus-assets/img/logos/mark.svg?color=indigo&shade=600"
                alt="Logo">
        </div>

        <div>
            @guest
                <box-icon name='user-circle' type='solid' color='#fdf7f7' class="md:hidden"></box-icon>
                <div class="hidden md:inline">
                    <a href="/login"
                        class="px-5 py-1 border-2 border-white m-2 rounded-2xl hover:bg-white hover:text-slate-900 transition">Login</a>
                    <a href="/register"
                        class="px-5 py-1 border-2 border-white rounded-2xl hover:bg-white hover:text-slate-900 transition">Sign
                        In</a>
                </div>
            @endguest

            @auth
                <div class="flex items-center space-x-3">
                    <img class="h-[35px] w-[35px] rounded-full border"
                        src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}" alt="Profile">
                    <span class="hidden md:inline">{{ Auth::user()->name }}</span>
                </div>
            @endauth
        </div>

        {{-- mobile navbar --}}
        <div class="inline md:hidden absolute">
            <div class="w-2xs bg-amber-900 h-screen">

            </div>
        </div>
    </nav>

    <section class="lg:flex">
        <aside class="md:w-1/6 w-full bg-slate-800 h-screen pt-2 fixed top-12 left-0 z-40 md:inline hidden text-center">
            <ul class="space-y-4 p-4">
                <li><a href="/" class="block text-white p-3 border-b-1">Home</a></li>
                <li><a href="#" class="block text-white p-3 border-b-1">Bookmark</a></li>
                <li><a href="#" class="block text-white p-3 border-b-1">Pengaturan</a></li>
                <li><a href="#" class="block text-white p-3 border-b-1">Logout</a></li>
            </ul>
        </aside>

        <main class="md:ml-[16.6667%] w-full bg-amber-50 min-h-screen p-6">
            <h1 class="text-2xl font-bold mb-4 text-blue-800">Konten Utama</h1>
            <p>Ini area utama dari halaman. Sidebar berada di sisi kiri dan sticky di desktop.</p>
        </main>
    </section>

</body>

</html>
