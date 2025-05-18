<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link
        href="https://fonts.googleapis.com/css2?family=Darumadrop+One&family=Lexend+Deca:wght@100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    @vite('resources/css/app.css')
    <title>Document</title>
</head>

{{-- sidebar --}}

<body class="bg-gray-100 flex min-h-screen">
    <div class="flex flex-col w-64 bg-white shadow-lg p-4 min-h-screen sticky border-r border-gray-300">
        <div class="flex items-center mb-4">
            <img src="img/Quack.jpg" alt="Logo" class="w-12 h-12 rounded-full mr-3" />
            <span class="text-2xl font-bold font-[Darumadrop_One]">Quack</span>
        </div>

        <div class="flex items-center p-3 rounded-lg cursor-pointer">
            <span class="mr-3 flex items-center justify-center w-8 h-8 rounded-full bg-yellow-300">
                <span class="material-symbols-outlined text-black">home</span>
            </span>
            <h2 class="text-md font-semibold font-poppins text-black">Home</h2>
        </div>

        <div class="flex items-center p-3 rounded-lg cursor-pointer">
            <span class="mr-3 flex items-center justify-center w-8 h-8 rounded-full bg-yellow-300">
                <span class="material-symbols-outlined text-black">search</span>
            </span>
            <h2 class="text-md font-semibold font-poppins text-black">Explore</h2>
        </div>

        <div class="flex items-center p-3 rounded-lg cursor-pointer">
            <span class="mr-3 flex items-center justify-center w-8 h-8 rounded-full bg-yellow-300">
                <span class="material-symbols-outlined text-black">notifications</span>
            </span>
            <h2 class="text-md font-semibold font-poppins text-black">Notifications</h2>
        </div>

        <div class="flex items-center p-3 rounded-lg cursor-pointer">
            <span class="mr-3 flex items-center justify-center w-8 h-8 rounded-full bg-yellow-300">
                <span class="material-symbols-outlined text-black">bookmark</span>
            </span>
            <h2 class="text-md font-semibold font-poppins text-black">Bookmarks</h2>
        </div>

        <div class="flex items-center p-3 rounded-lg cursor-pointer">
            <span class="mr-3 flex items-center justify-center w-8 h-8 rounded-full bg-yellow-300">
                <span class="material-symbols-outlined text-black">person</span>
            </span>
            <h2 class="text-md font-semibold font-poppins text-black">Profile</h2>
        </div>
        @if (Auth::check() && Auth::user()->role === 'admin')
            <div class="flex items-center p-3 rounded-lg cursor-pointer">
                <span class="mr-3 flex items-center justify-center w-8 h-8 rounded-full bg-yellow-300">
                    <span class="material-symbols-outlined text-black">person</span>
                </span>
                <h2 class="text-md font-semibold font-poppins text-black">Admin Dashboard</h2>
            </div>
        @endif

        <div class="flex-1"></div>
        <a href="/logout" class="mx-auto px-6 py-2 mb-2 bg-amber-500 hover:bg-amber-600 rounded-full font-semibold">Log
            out</a>
    </div>

    {{-- feed --}}
    <div class="flex-1 max-w- border-r border-gray-300 bg-white flex flex-col overflow-y-auto h-screen no-scrollbar">
        <div class="bg-yellow-300 rounded-b-2xl px-6 py-4">
            <div class="mb-2">
                <span class="text-sm font-semibold text-gray-500 font-[Poppins,Arial,sans-serif]">make a new
                    post</span>
            </div>
            <div class="flex items-start gap-4 mt-0">
                <img src="{{ asset('storage/' . Auth::user()->profile) }}" alt="Profile"
                    class="w-12 h-12 rounded-full object-cover shrink-0" />
                <input type="text"
                    class="flex-1 border-none outline-none rounded-[24px] px-5 py-[18px] text-[1.1rem] bg-white mr-3 font-[Poppins,Arial,sans-serif] self-center"
                    placeholder="Quack!!!" />
                <button
                    class="bg-orange-500 hover:bg-yellow-400 text-black rounded-full px-7 py-[10px] text-base font-medium font-[Poppins,Arial,sans-serif] cursor-pointer self-center">
                    Post
                </button>
            </div>
        </div>

        {{-- post 1 --}}
        <div class="bg-white border-1 mx-auto flex flex-col max-w-[650px] p-5 relative border-gray-300">
            <div class="flex justify-between">
                <div class="flex flex-row">
                    <div>
                        <img src="img/profile.png" alt="" class="max-w-[40px] max-h-[40px]">
                    </div>
                    <div class="px-4">
                        <h3 class="font-bold">Roux</h3>
                        <p class="text-sm text-justify">Lorem ipsum dolor sit amet consectetur adipisicing elit. Velit
                            architecto eligendi quaerat odit ipsum illum pariatur culpa tempora omnis magnam iusto,
                            sapiente molestiae nisi necessitatibus! Quos doloremque fugit asperiores enim.</p>
                    </div>
                </div>
                <p class="text-xl cursor-pointer">•••</p>
            </div>
            <div>
                <img src="img/car.jpg" alt="" class="w-full max-w-2xs block mx-auto mt-3 rounded-lg" />
            </div>
            <div class="flex items-center justify-between mt-4 px-2">
                <div class="flex items-center gap-1.5">
                    <img src="img/QuackIcon.png" alt="Custom Icon" class="aspect-square h-7 w-7 cursor-pointer" />
                    <span class="text-gray-500 text-sm font-medium ml-1">22.5K</span>
                </div>
                <div class="flex items-center gap-4.5">
                    <span class="material-symbols-outlined text-2xl text-gray-700 cursor-pointer">mode_comment</span>
                    <span class="material-symbols-outlined text-2xl text-gray-700 cursor-pointer">bookmark</span>
                </div>
            </div>
        </div>
    </div>

    {{-- widget --}}
    <div class="widgets w-80 flex flex-col gap-6 overflow-y-auto h-screen no-scrollbar">
        <div class="bg-white rounded-b-md shadow p-6 border border-gray-200 mb-5">
            <h2 class="text-lg font-semibold mb-3 font-poppins">Topics you might like</h2>
            <div class="mb-2 text-blue-500">#Brainrot</div>
            <img src="img/BomCroc.jpg" alt="Topic Image" class="w-full rounded-lg mt-2 mb-2 object-cover" />
        </div>

        <div class="bg-white rounded-t shadow p-6 border border-gray-200">
            <h2 class="text-base font-semibold mb-4 font-poppins">Friends you might know</h2>
            <div class="flex items-center gap-3 mb-4">
                <img src="img/profile.png" alt="Zephyx2606" class="w-10 h-10 rounded-full object-cover" />
                <span class="font-poppins text-base font-medium text-gray-900">Zephyx2606</span>
            </div>
            <div class="flex items-center gap-3 mb-4">
                <img src="img/profile.png" alt="Savr" class="w-10 h-10 rounded-full object-cover" />
                <span class="font-poppins text-base font-medium text-gray-900">Savr</span>
            </div>
            <div class="flex items-center gap-3">
                <img src="img/profile.png" alt="Banzaimoo" class="w-10 h-10 rounded-full object-cover" />
                <span class="font-poppins text-base font-medium text-gray-900">Banzaimoo</span>
            </div>
        </div>
    </div>
</body>

</html>
