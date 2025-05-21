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
    <title>Profile</title>
</head>

<body class="bg-gray-100 flex min-h-screen">
    {{-- Sidebar --}}
    <x-sidebar />

    {{-- Konten tengah --}}
    <div class="flex-1 max-w- border-r border-gray-300 bg-white flex flex-col overflow-y-auto h-screen no-scrollbar">
        <div class="flex flex-col items-center py-8">
            <img src="{{ asset('storage/' . Auth::user()->profile) }}" alt="Profile"
                class="w-28 h-28 rounded-full object-cover" />
            <h2 class="text-xl font-bold mt-4">{{ Auth::user()->username }}</h2>

            <div class="flex gap-2 mt-4">
                <button class="border px-4 py-1 rounded-full">Edit Profile</button>
                <button class="border px-4 py-1 rounded-full">Share Profile</button>
            </div>

            <div class="flex gap-6 mt-4 text-center">
                <div>
                    <p class="font-bold">{{ $postCount ?? 0 }}</p>
                    <p class="text-sm">Post</p>
                </div>
                <div>
                    <p class="font-bold">{{ $followerCount ?? 0 }}</p>
                    <p class="text-sm">Follows</p>
                </div>
                <div>
                    <p class="font-bold">{{ $followingCount ?? 0 }}</p>
                    <p class="text-sm">Following</p>
                </div>
            </div>

            <p class="mt-4 text-sm text-gray-500">Edit your bio here</p>
        </div>

        {{-- Posts user --}}
        <div class="space-y-4 px-6 pb-10">
            @foreach ($posts as $post)
                <x-post :post="$post" />
            @endforeach
        </div>
    </div>

    {{-- Sidebar kanan --}}
    <x-widget />
</body>

</html>
