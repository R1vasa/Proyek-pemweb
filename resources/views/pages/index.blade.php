<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>Document</title>
</head>

<body>
    <nav class="flex justify-between items-center bg-blue-800 text-white px-7 lg:px-20 h-12">
        <div>
            <img class="h-[35px]" src="https://tailwindcss.com/plus-assets/img/logos/mark.svg?color=indigo&shade=600"
                alt="">
        </div>
        <div>
            @guest
                <div class="hidden md:inline">
                    <a href="/login" class="px-5 py-1 border-2 m-2 rounded-2xl">Login</a>
                    <a href="/register" class="px-5 py-1 border-2 rounded-2xl">Sign in</a>
                </div>
            @endguest

            @auth
                <img class="h-[35px]" src="https://tailwindcss.com/plus-assets/img/logos/mark.svg?color=indigo&shade=600"
                    alt="">
            @endauth
        </div>
    </nav>

    <aside>
        <ul>
            <li>Home</li>
            <li>Bookmark</li>
            <li></li>
            <li></li>
        </ul>
    </aside>
</body>

</html>
