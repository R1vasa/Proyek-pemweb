 <div class="flex flex-col w-64 bg-white shadow-lg p-4 min-h-screen sticky border-r border-gray-300">
        <div class="flex items-center mb-4">
            <img src="{{ asset('img/Quack.jpg') }}" alt="Logo" class="w-12 h-12 rounded-full mr-3" />
            <span class="text-2xl font-bold font-[Darumadrop_One]">Quack</span>
        </div>

        <div class="flex items-center p-3 rounded-lg cursor-pointer">
            <span class="mr-3 flex items-center justify-center w-8 h-8 rounded-full bg-yellow-300">
                <span class="material-symbols-outlined text-black">home</span>
            </span>
            @if (Auth::check() && Auth::user()->role === 'admin')
                <a href="/admin">
                    <h2 class="text-md font-semibold font-poppins text-black">Home</h2>
                </a>
            @else
                <a href="/home">
                    <h2 class="text-md font-semibold font-poppins text-black">Home</h2>
                </a>
            @endif
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
            @if (Auth::check())
                <a href="/profile">
                    <h2 class="text-md font-semibold font-poppins text-black">Profile</h2>
                </a>
            @endif
        </div>

        @if (Auth::check() && Auth::user()->role === 'admin')
            <div class="flex items-center p-3 rounded-lg cursor-pointer">
                <span class="mr-3 flex items-center justify-center w-8 h-8 rounded-full bg-yellow-300">
                    <span class="material-symbols-outlined text-black">person</span>
                </span>
                <a href="/admin/dashboard">
                    <h2 class="text-md font-semibold font-poppins text-black">Admin Control</h2>
                </a>
            </div>
        @endif

        <div class="flex-1"></div>
        <a href="/logout" class="mx-auto px-6 py-2 mb-2 bg-amber-500 hover:bg-amber-600 rounded-full font-semibold">Log
            out</a>
    </div>
