<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>Document</title>
</head>

<body>
    <nav class="flex justify-between items-center bg-blue-800 text-white px-7 lg:px-20 h-12 sticky top-0 z-50">
        <div>
            <img class="h-[35px]" src="https://tailwindcss.com/plus-assets/img/logos/mark.svg?color=indigo&shade=600"
                alt="Logo">
        </div>

        <div>
            @guest
                <div class="hidden md:inline">
                    <a href="/login"
                        class="px-5 py-1 border-2 border-white m-2 rounded-2xl hover:bg-white hover:text-blue-800 transition">Login</a>
                    <a href="/register"
                        class="px-5 py-1 border-2 border-white rounded-2xl hover:bg-white hover:text-blue-800 transition">Sign
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
    </nav>

    <section class="lg:flex">
        <aside class="lg:w-1/6 w-full lg:block bg-amber-400 h-screen pt-16 fixed top-12 left-0 z-40">
            <ul class="space-y-4 p-4">
                <li><a href="#" class="block hover:text-white">Home</a></li>
                <li><a href="#" class="block hover:text-white">Bookmark</a></li>
                <li><a href="#" class="block hover:text-white">Pengaturan</a></li>
                <li><a href="#" class="block hover:text-white">Logout</a></li>
            </ul>
        </aside>

        <main class="lg:ml-[16.6667%] w-full bg-amber-50 min-h-screen p-6">
            <h1 class="text-2xl font-bold mb-4 text-blue-800">Konten Utama</h1>
            <p>Ini area utama dari halaman. Sidebar berada di sisi kiri dan sticky di desktop.</p>
        </main>
    </section>

</body>

</html>
