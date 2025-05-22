<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <title>Quack Dashboard</title>
    @vite('resources/css/app.css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <style>
        .custom-scrollbar::-webkit-scrollbar {
            width: 6px;
        }

        .custom-scrollbar::-webkit-scrollbar-track {
            background: transparent;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background-color: #facc15;
            border-radius: 10px;
        }

        body,
        html {
            margin: 0;
            padding: 0;
            width: 100%;
            height: 100%;
        }
    </style>
</head>

<body class="min-h-full">
    <div class="bg-white w-full h-full flex overflow-hidden">
        <x-sidebar></x-sidebar>

        <main class="flex-1 p-6 space-y-6 overflow-auto">
            <section class="border border-gray-300 rounded-md p-4 max-h-[180px] overflow-y-auto custom-scrollbar">
                <h2 class="text-xs text-black mb-3 select-none">
                    User Analytics
                </h2>
                <ul class="space-y-3">
                    @foreach ($user as $users)
                        <li class="flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <div
                                    class="w-8 h-8 rounded-full bg-purple-200 text-purple-700 flex items-center justify-center font-semibold select-none">
                                    A
                                </div>
                                <span class="text-xs text-black select-none">
                                    <h2>{{ $users->username }} ({{ $users->email }})</h2>
                                </span>
                            </div>
                            <!-- Dropdown for actions -->
                            <div style="position: relative; display: inline-block;">
                                <button id="actionBtn{{ $users->id }}" class="fas fa-cog text-black text-sm cursor-pointer"
                                    type="button" onclick="toggleDropdown('dropdown{{ $users->id }}')" aria-haspopup="true"
                                    aria-expanded="false"
                                    style="background: none; border: none; outline: none; font-size: 1.1rem;"></button>

                                <div id="dropdown{{ $users->id }}" class="dropdown-content"
                                    style="display:none; position: absolute; right: 0; background: white; border: 1px solid #ccc; border-radius: 4px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); z-index: 10; min-width: 120px;">
                                    <!-- Delete user form -->
                                    <form action="{{ route('users.destroy', $users->id) }}" method="POST"
                                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus user ini?')"
                                        style="margin: 0;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            style="all: unset; cursor: pointer; padding: 8px 12px; display: block; width: 100%; text-align: left; color: #e3342f;">Hapus
                                            User</button>
                                    </form>
                                    <!-- Ban user form -->
                                    <form action="{{ route('users.ban', $users->id) }}" method="POST"
                                        onsubmit="return confirm('Apakah Anda yakin ingin membanned user ini?')"
                                        style="margin: 0;">
                                        @csrf
                                        <button type="submit"
                                            style="all: unset; cursor: pointer; padding: 8px 12px; display: block; width: 100%; text-align: left; color: #f59e0b;">Ban
                                            User</button>
                                    </form>
                                    <!-- Unban user form -->
                                    <form action="{{ route('users.unban', $users->id) }}" method="POST"
                                        onsubmit="return confirm('Apakah Anda yakin ingin mencabut ban user ini?')"
                                        style="margin: 0;">
                                        @csrf
                                        <button type="submit"
                                            style="all: unset; cursor: pointer; padding: 8px 12px; display: block; width: 100%; text-align: left; color: #34d399;">Cabut
                                            Ban User</button>
                                    </form>
                                    <!-- Make admin form -->
                                    <form action="{{ route('users.makeAdmin', $users->id) }}" method="POST"
                                        onsubmit="return confirm('Apakah Anda yakin ingin menjadikan user ini sebagai admin?')"
                                        style="margin: 0;">
                                        @csrf
                                        <button type="submit"
                                            style="all: unset; cursor: pointer; padding: 8px 12px; display: block; width: 100%; text-align: left; color: #3b82f6;">Jadikan
                                            Admin</button>
                                    </form>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </section>

            <section class="border border-gray-300 rounded-md p-4">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-xs text-black select-none">Traffic Analytics</h2>
                </div>
                <div class="flex gap-4 w-full justify-between">
                    <div class="bg-[#f7fce9] rounded-md px-4 py-3 text-center w-full">
                        <p class="text-[10px] text-black mb-1 select-none">
                            concurrent active users
                        </p>
                        <p class="font-bold text-lg text-black select-none">
                            750.1K
                        </p>
                        <p class="text-[10px] text-green-500 font-semibold select-none">
                            +10,46%
                        </p>
                    </div>
                    <div class="bg-[#f7fce9] rounded-md px-4 py-3 text-center w-full">
                        <p class="text-[10px] text-black mb-1 select-none">
                            Total Users
                        </p>
                        <p class="font-bold text-lg text-black select-none">
                            1.8 M
                        </p>
                        <p class="text-[10px] text-green-500 font-semibold select-none">
                            +9,6%
                        </p>
                    </div>
                    <div class="bg-[#f7fce9] rounded-md px-4 py-3 text-center w-full">
                        <p class="text-[10px] text-black mb-0 select-none">
                            Avg Visit Duration
                        </p>
                        <p class="text-[8px] text-black mb-1 select-none">
                            1 month time frame
                        </p>
                        <p class="font-bold text-lg text-black select-none">
                            12:03
                        </p>
                        <p class="text-[10px] text-green-500 font-semibold select-none">
                            +3,8%
                        </p>
                    </div>
                </div>
                <h2 class="text-xs text-right text-black select-none cursor-pointer">
                    view more
                </h2>
            </section>
        </main>
    </div>

    <script>
        // toggles dropdown visibility
        function toggleDropdown(id) {
            var el = document.getElementById(id);
            var isVisible = el.style.display === 'block';
            closeAllDropdowns();
            if (!isVisible) {
                el.style.display = 'block';
                document.addEventListener('click', outsideClickListener);
            }
        }

        function closeAllDropdowns() {
            var dropdowns = document.querySelectorAll('.dropdown-content');
            dropdowns.forEach(function (d) {
                d.style.display = 'none';
            });
            document.removeEventListener('click', outsideClickListener);
        }

        function outsideClickListener(event) {
            if (!event.target.closest('.dropdown-content') && !event.target.closest('[id^=actionBtn]')) {
                closeAllDropdowns();
            }
        }
    </script>
</body>

</html>