<?php
    use App\Http\Controllers\PostsController;

    $PostModel = new PostsController();
    $postData = $PostModel->get_posts();
?>

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



<body class="bg-gray-100 flex min-h-screen">
    {{-- sidebar --}}
    <!-- Manggil Sidebar pake ini -->
    <x-sidebar /> 

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
    <!-- Manggil Post pake ini -->

    <x-post/>

    {{-- post 2 --}}
    </div>

    {{-- sidebar --}}
    {{-- widget --}}
    <x-widget/>
</body>

</html>
