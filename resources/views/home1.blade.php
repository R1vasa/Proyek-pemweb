<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
    @vite(resources/css/app.css)
    <title>Document</title>
</head>

<body class="bg-gray-100 flex min-h-screen">
    <div class="sidebar flex flex-col w-64 bg-white shadow-lg p-4 min-h-screen sticky">
        <div class="sidebarHeader flex items-center mb-8">
            <img src="Quack.jpg" alt="Logo" class="w-12 h-12 rounded-full mr-3" />
            <span class="sidebarTitle text-2xl font-bold font-darumadrop">Quack</span>
        </div>
        <div class="sidebarOption flex items-center p-3 rounded-lg hover:bg-gray-200 mb-2 cursor-pointer">
            <span class="sidebarIconBg mr-3">
                <span class="material-symbols-outlined">home</span>
            </span>
            <h2 class="text-lg font-semibold">Home</h2>
        </div>
        <div class="sidebarOption flex items-center p-3 rounded-lg hover:bg-gray-200 mb-2 cursor-pointer">
            <span class="sidebarIconBg mr-3">
                <span class="material-symbols-outlined">search</span>
            </span>
            <h2 class="text-lg font-semibold">Explore</h2>
        </div>
        <div class="sidebarOption flex items-center p-3 rounded-lg hover:bg-gray-200 mb-2 cursor-pointer">
            <span class="sidebarIconBg mr-3">
                <span class="material-symbols-outlined">notifications</span>
            </span>
            <h2 class="text-lg font-semibold">Notifications</h2>
        </div>
        <div class="sidebarOption flex items-center p-3 rounded-lg hover:bg-gray-200 mb-2 cursor-pointer">
            <span class="sidebarIconBg mr-3">
                <span class="material-symbols-outlined">bookmark</span>
            </span>
            <h2 class="text-lg font-semibold">Bookmarks</h2>
        </div>
        <div class="sidebarOption flex items-center p-3 rounded-lg hover:bg-gray-200 mb-2 cursor-pointer">
            <span class="sidebarIconBg mr-3">
                <span class="material-symbols-outlined">person</span>
            </span>
            <h2 class="text-lg font-semibold">Profile</h2>
        </div>
        <div class="flex-1"></div>
        <button
            class="block mx-auto w-3/5 bg-orange-500 text-black font-semibold rounded-full h-10 text-lg hover:bg-orange-400 transition-colors">
            Log Out
        </button>
    </div>

    <div
        class="feed flex-1 max-w-[75%] border-r border-[#e6ecf0] bg-white flex flex-col overflow-y-auto h-screen no-scrollbar">
        <div class="bg-[#ffe529] rounded-b-[18px] px-6 py-[18px]">
            <div class="mb-2">
                <span class="text-[1.1rem] font-semibold text-[#666] font-[Poppins,Arial,sans-serif]">make a new
                    post</span>
            </div>
            <div class="flex items-start gap-4 mt-0">
                <img src="profile.png" alt="Profile" class="w-[72px] h-[72px] rounded-full object-cover shrink-0" />
                <input type="text"
                    class="flex-1 border-none outline-none rounded-[24px] px-5 py-[18px] text-[1.1rem] bg-white mr-3 font-[Poppins,Arial,sans-serif] self-center"
                    placeholder="Quack!!!" />
                <button
                    class="bg-orange-500 hover:bg-[#ffb300] text-[#222] rounded-full px-7 py-[10px] text-base font-medium font-[Poppins,Arial,sans-serif] cursor-pointer self-center">
                    Post
                </button>
            </div>
        </div>

        <div class="bg-white border-2 mx-auto flex flex-col max-w-[650px] p-5 relative border-gray-300">
            <div class="flex justify-between">
                <div class="flex flex-row">
                    <div>
                        <img src="profile.png" alt="" class="max-w-[40px] max-h-[40px]">
                    </div>
                    <div class="px-4">
                        <h3 class="font-bold">Roux</h3>
                        <p class="text-sm text-justify">Lorem ipsum dolor sit amet consectetur adipisicing elit. Velit
                            architecto eligendi quaerat odit ipsum illum pariatur culpa tempora omnis magnam iusto,
                            sapiente molestiae nisi necessitatibus! Quos doloremque fugit asperiores enim.</p>
                    </div>
                </div>
                <p class="text-xl">•••</p>
            </div>
            <div class="post_body">
                <img src="car.jpg" alt="" class="w-full max-w-[400px] block mx-auto mt-6 rounded-lg" />
            </div>
            <div class="post_footer flex items-center justify-between mt-4 px-2">
                <div class="post_footer_left flex items-center gap-1.5">
                    <img src="QuackIcon.png" alt="Custom Icon" class="w-7 h-7 align-middle cursor-pointer" />
                    <span class="text-gray-500 text-[18px] font-medium ml-1">22.5K</span>
                </div>
                <div class="post_footer_right flex items-center gap-4.5">
                    <span class="material-symbols-outlined text-2xl text-gray-700 cursor-pointer">mode_comment</span>
                    <span class="material-symbols-outlined text-2xl text-gray-700 cursor-pointer">bookmark</span>
                </div>
            </div>
        </div>

        <!-- post 2 -->
        <div class="bg-white border-2 mx-auto flex flex-col max-w-[650px] p-5 relative border-gray-300">
            <div class="flex justify-between">
                <div class="flex flex-row">
                    <div>
                        <img src="profile.png" alt="" class="max-w-[40px] max-h-[40px]">
                    </div>
                    <div class="px-4">
                        <h3 class="font-bold">Roux</h3>
                        <p class="text-sm text-justify">Lorem ipsum dolor sit amet consectetur adipisicing elit. Velit
                            architecto eligendi quaerat odit ipsum illum pariatur culpa tempora omnis magnam iusto,
                            sapiente molestiae nisi necessitatibus! Quos doloremque fugit asperiores enim.</p>
                    </div>
                </div>
                <p class="text-xl">•••</p>
            </div>
            <div class="post_body">
                <img src="car.jpg" alt="" class="w-full max-w-[400px] block mx-auto mt-6 rounded-lg" />
            </div>
            <div class="post_footer flex items-center justify-between mt-4 px-2">
                <div class="post_footer_left flex items-center gap-1.5">
                    <img src="QuackIcon.png" alt="Custom Icon" class="w-7 h-7 align-middle cursor-pointer" />
                    <span class="text-gray-500 text-[18px] font-medium ml-1">22.5K</span>
                </div>
                <div class="post_footer_right flex items-center gap-4.5">
                    <span class="material-symbols-outlined text-2xl text-gray-700 cursor-pointer">mode_comment</span>
                    <span class="material-symbols-outlined text-2xl text-gray-700 cursor-pointer">bookmark</span>
                </div>
            </div>
        </div>
    </div>

    <div class="widgets w-80 flex flex-col gap-6 h-screen">

        <div class="bg-white rounded-b-md shadow p-6 border border-gray-200 mb-20">
            <h2 class="text-lg font-semibold mb-3 font-poppins">Topics you might like</h2>
            <div class="mb-2 text-blue-500">#Brainrot</div>
            <img src="BomCroc.jpg" alt="Topic Image" class="w-full rounded-lg mt-2 mb-2 object-cover" />
        </div>

        <div class="bg-white rounded-t shadow p-6 border border-gray-200 mt-10">
            <h2 class="text-base font-semibold mb-4 font-poppins">Friends you might know</h2>
            <div class="flex items-center gap-3 mb-4">
                <img src="profile.png" alt="Zephyx2606" class="w-10 h-10 rounded-full object-cover" />
                <span class="font-poppins text-base font-medium text-gray-900">Zephyx2606</span>
            </div>
            <div class="flex items-center gap-3 mb-4">
                <img src="profile.png" alt="Savr" class="w-10 h-10 rounded-full object-cover" />
                <span class="font-poppins text-base font-medium text-gray-900">Savr</span>
            </div>
            <div class="flex items-center gap-3">
                <img src="profile.png" alt="Banzaimoo" class="w-10 h-10 rounded-full object-cover" />
                <span class="font-poppins text-base font-medium text-gray-900">Banzaimoo</span>
            </div>
        </div>

    </div>
</body>

</html>