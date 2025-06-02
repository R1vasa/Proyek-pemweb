<?php
use App\Http\Controllers\UsersController;
$userModel = new UsersController();
$userData = $userModel->get_user();
?>
<div class="widgets w-80 flex flex-col gap-6 overflow-y-auto h-screen no-scrollbar">
    <div class="bg-white rounded-b-md shadow p-6 border border-gray-200 mb-5">
        <h2 class="text-lg font-semibold mb-3 font-poppins">Topics you might like</h2>
        <div class="mb-2 text-blue-500">#Brainrot</div>
    </div>
    <div class="bg-white rounded-t shadow p-6 border border-gray-200">
        <h2 class="text-lg font-semibold mb-3 font-poppins">Friends you might know</h2>
        @foreach ($userData->filter(function ($user) {
            return $user->id !== Auth::id() && $user->role !== 'admin' && $user->role !== 'banned';
        })->shuffle()->take(3) as $user)
            <div class="flex items-center gap-3 mb-4">
                <a href="{{ route('profile', ['username' => $user->username]) }}" class="flex items-center gap-3">
                    <img src="{{ asset('storage/' . $user->profile) }}" alt="Profile"
                        class="w-10 h-10 rounded-full object-cover" />
                    <span class="font-poppins text-base font-medium text-gray-900">{{ $user->username }}</span>
                </a>
            </div>
        @endforeach
    </div>
</div>
