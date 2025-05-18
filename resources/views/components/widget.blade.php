<?php
    use App\Http\Controllers\UsersController;
    $userModel = new UsersController();
    $userData = $userModel->get_user();
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
    <div class="widgets w-80 flex flex-col gap-6 overflow-y-auto h-screen no-scrollbar">
        <div class="bg-white rounded-b-md shadow p-6 border border-gray-200 mb-5">
            <h2 class="text-lg font-semibold mb-3 font-poppins">Topics you might like</h2>
            <div class="mb-2 text-blue-500">#Brainrot</div>
            <img src="img/BomCroc.jpg" alt="Topic Image" class="w-full rounded-lg mt-2 mb-2 object-cover" />
        </div>
        <div class="bg-white rounded-t shadow p-6 border border-gray-200">
            
            @foreach ($userData as $user)
                <div class="flex items-center gap-3 mb-4">
                    <img src="img/profile.png" alt="Zephyx2606" class="w-10 h-10 rounded-full object-cover" />
                    <span class="font-poppins text-base font-medium text-gray-900">{{$user->username}}</span>
                </div>
            @endforeach
        </div> 
    </div>
</body>
</html>