<!DOCTYPE html>
<html lang="en" class="h-full">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    {{-- font --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Darumadrop+One&family=Lexend+Deca:wght@100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    <title>Register</title>
</head>

<body class="h-full">
    <div
        class="flex min-h-full flex-col justify-center items-center bg-cover bg-center bg-no-repeat bg-[url(/public/images/background.jpg)]">
        <div class="sm:w-[420px] w-full p-4 rounded-4xl bg-white">
            <div class="sm:mx-auto sm:w-full sm:max-w-sm p-3">
                <p class="text-sm sm:text-base font-medium">Tambahkan foto profil untuk membuat akunmu lebih personal
                    dan mudah dikenali!</p>
            </div>

            <div class="mt-5 sm:mx-auto sm:w-full sm:max-w-sm">
                <form class="space-y-6" action="/register/profile/store " method="POST" enctype="multipart/form-data">
                    @csrf

                    <div>
                        <img src="/images/default.png" id="preview" alt=""
                            class="mx-auto rounded-full object-cover" style="width: 120px; height: 120px;">
                        <div class="flex justify-center mt-5">
                            <label for="profile"
                                class="cursor-pointer inline-block bg-yellow-300 hover:bg-yellow-400 text-black text-sm font-semibold py-2 px-4 rounded-3xl">
                                Pilih Foto
                            </label>
                            <input type="file" name="profile" id="profile" class="hidden" accept="image/*"
                                onchange="previewImage()">
                        </div>
                    </div>

                    <div class="px-16">
                        <label for="username" class="block text-sm/6 font-medium text-gray-900">Username</label>
                        <div class="mt-2 flex items-center gap-2 border-b border-gray-300">
                            <i class='bx bx-user text-xl text-gray-500'></i>
                            <input type="text" name="username" id="username" value="{{ old('username') }}"
                                placeholder="Type your Username"
                                class="w-full sm:text-base text-sm focus:outline-none py-2">
                        </div>
                    </div>

                    <div class="flex justify-center">
                        <button type="submit"
                            class="cursor-pointer w-1/3 max-w-xs rounded-md bg-yellow-300 px-3 py-1.5 text-sm font-semibold text-black shadow hover:bg-yellow-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500">
                            Register
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
    <script>
        function previewImage() {
            const input = document.getElementById("profile");
            const preview = document.getElementById("preview");

            const file = input.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        }
    </script>
</body>

</html>
