<?php

use App\Http\Controllers\PostsController;

$PostModel = new PostsController();
$postData = $PostModel->get_posts();
?>

@extends('layout.app')

@section('title', 'Home')

@section('body')
    {{-- sidebar --}}
    <!-- Manggil Sidebar pake ini -->
    <x-sidebar />

    {{-- feed --}}
    <div class="flex-1 max-w- border-r border-gray-300 bg-white flex flex-col overflow-y-auto h-screen no-scrollbar">
        <div class="bg-yellow-300 rounded-b-2xl px-6 py-4">
            <div class="mb-2">
                <span class="text-lg font-semibold text-gray-600 font-[Poppins,Arial,sans-serif]">make a new post</span>
            </div>
            <form action="{{ url('/posts') }}" method="POST" enctype="multipart/form-data"
                class="flex items-center gap-4 mt-0">
                @csrf
                <!-- Profile image -->
                <img src="{{ asset('storage/' . Auth::user()->profile) }}" alt="Profile"
                    class="w-14 h-14 rounded-full object-cover shrink-0" />
                <!-- Textarea and image controls -->
                <div class="relative flex-1 flex flex-col">
                    <textarea name="content"
                        class="w-full border-none outline-none rounded-2xl px-6 py-4 text-base bg-white font-[Poppins,Arial,sans-serif] pr-12 resize-none no-scrollbar"
                        placeholder="Quack!!!" maxlength="2200" rows="3" style="overflow: auto; scrollbar-width: none;"></textarea>
                    <label for="image-upload" class="absolute right-12 top-1/2 -translate-y-1/2 cursor-pointer">
                        <i class="fa-regular fa-image text-2xl text-gray-400 hover:text-gray-600"></i>
                    </label>
                    <button type="button" id="remove-image-btn"
                        class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-red-500 text-2xl"
                        style="display:none;" tabindex="-1" aria-label="Remove image">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                    <input id="image-upload" type="file" name="image" accept="image/*" class="hidden" />
                    <!-- Image preview (absolute, does not affect layout) -->
                    <div id="newPostImagePreviewContainer" class="w-full flex justify-center mt-2">
                        <div id="newPostImageBox" class="bg-white rounded-2xl shadow p-4" style="display:none;">
                            <img id="newPostImagePreview" src="" alt="Preview"
                                class="max-h-72 max-w-full rounded-lg" style="display:block;" />
                        </div>
                    </div>
                </div>
                <!-- Post button -->
                <button type="submit"
                    class="bg-orange-500 hover:bg-yellow-400 text-black rounded-full px-8 py-3 text-lg font-medium font-[Poppins,Arial,sans-serif] cursor-pointer transition-all">
                    Post
                </button>
            </form>
        </div>

        <!-- Manggil Post pake ini -->
        <x-post />
    </div>

    {{-- widget --}}
    <x-widget />

@endsection

@if (session('success'))
    <script>
        localStorage.removeItem("previewProfileImage");
    </script>
@endif
</body>

</html>