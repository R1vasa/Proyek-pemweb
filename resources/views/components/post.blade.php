<?php
    namespace App\View\Components;
    use App\Http\Controllers\PostsController;

    $postModel = new PostsController();
    $postData = $postModel->get_posts();
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
<body>
    @foreach($postData as $post)
        <div class="bg-white border-1 mx-auto max-w-[650px] w-[70%] p-5 relative border-gray-300 flex-shrink-0 flex-grow-0">
            <div class="flex justify-between">
                <div class="flex flex-row">
                    <div>
                        <!-- TODO: masukkin foto profile, ini masih pake dummy -->
                        <img src="img/profile.png" alt="Profile" class="max-w-[40px] max-h-[40px]">
                    </div>
                    <div class="px-4">
                        <h3 class="font-bold">{{$post->user->username}}</h3>
                        <p class="text-sm text-justify">{{$post->content}}</p>
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
                    <span class="text-gray-500 text-sm font-medium ml-1">22.5K(belum dipasang)</span>
                </div>
                <div class="flex items-center gap-4.5">
                    <span class="material-symbols-outlined text-2xl text-gray-700 cursor-pointer">mode_comment</span>
                    <span class="material-symbols-outlined text-2xl text-gray-700 cursor-pointer">bookmark</span>
                </div>
            </div>
        </div>
    @endforeach
</body>
</html>