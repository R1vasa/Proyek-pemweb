<?php

?>

@extends('layout.app')

@section('title', 'Home')

@section('body')
    {{-- sidebar --}}
    <!-- Manggil Sidebar pake ini -->
    <x-sidebar />

    {{-- feed --}}
    <div class="flex-1 border-r border-gray-300 bg-white flex flex-col overflow-y-auto h-screen no-scrollbar">
        <div class="bg-white border mx-auto w-[100%] p-5 relative border-gray-300 flex-shrink-0 flex-grow-0 mb-0">
            <div class="flex justify-between">
                <div class="flex flex-row">
                    <div>
                        <img src="{{ asset('storage/' . ($post->user->profile ?? 'profile.png')) }}" alt="Profile"
                            class="w-10 h-10 rounded-full object-cover">
                    </div>
                    <div class="px-4">
                        <h3 class="font-bold">{{ $post->user->username }}</h3>
                        <span
                            class="text-xs text-gray-500">{{ $post->created_at ? $post->created_at->diffForHumans() : '' }}</span>

                        <p class="text-sm text-justify">{{ $post->content }}</p>
                    </div>
                </div>
            </div>
            @if ($post->img_content)
                <div>
                    <img src="{{ asset('storage/' . $post->img_content) }}" alt="Post image"
                        class="w-full max-w-2xs block mx-auto mt-3 rounded-lg" />
                </div>
            @endif
            <div class="flex items-center justify-between mt-4 px-2">
                <div class="flex items-center gap-2">
                    <button class="like-btn" data-post="{{ $post->id }}"
                        style="background:none;border:none;outline:none;cursor:pointer;">
                        <img src="{{ $post->likes->where('user_id', Auth::id())->count() ? asset('img/QuackClicked.jpg') : asset('img/QuackIcon.png') }}"
                            alt="Like Icon" class="aspect-square h-7 w-7 cursor-pointer" />
                    </button>
                    <span
                        class="text-gray-500 text-sm font-medium ml-1 like-count-{{ $post->id }}">{{ $post->likes->count() ?? 0 }}</span>
                </div>
                <div class="flex items-center gap-4">
                    <span
                        class="material-symbols-outlined text-2xl text-gray-700 cursor-pointer bookmark-icon">bookmark</span>
                </div>
            </div>
        </div>

        <!-- WRITE COMMENTS-->
        <div class="bg-yellow-300 px-6 py-4 w-[100%] mx-auto mt-[0]">
            <div class="mb-2">
                <span class="text-lg font-semibold text-gray-600 font-[Poppins,Arial,sans-serif]">Leave a new comment</span>
            </div>
            <form action="{{ route('comments.store', ['id' => $post->id]) }}" method="POST" enctype="multipart/form-data"
                class="flex items-center gap-4 mt-0">
                @csrf
                <input type="hidden" name="post_id" value="{{ $post->id }}">
                <!-- Profile image -->
                <img src="{{ asset('storage/' . Auth::user()->profile) }}" alt="Profile"
                    class="w-14 h-14 rounded-full object-cover shrink-0" />
                <!-- Textarea and image controls -->
                <div class="relative flex-1 flex flex-col">
                    <textarea name="comment"
                        class="w-full border-none outline-none rounded-2xl px-6 py-4 text-base bg-white font-[Poppins,Arial,sans-serif] pr-12 resize-none no-scrollbar"
                        placeholder="nice Quack!!" maxlength="2200" rows="3" style="overflow: auto; scrollbar-width: none;"></textarea>
                </div>
                <!-- Post button -->
                <button type="submit"
                    class="bg-orange-500 hover:bg-yellow-400 text-black rounded-full px-8 py-3 text-lg font-medium font-[Poppins,Arial,sans-serif] cursor-pointer transition-all">
                    Post
                </button>
            </form>
        </div>

        <!-- for all comments -->
        @foreach ($comments as $comment)
            <x-comment :comment="$comment" />
        @endforeach
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
