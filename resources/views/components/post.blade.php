<?php

namespace App\View\Components;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PostsController;

$postModel = new PostsController();
$postData = $postModel->get_posts();
?>

@foreach ($postData as $post)
    <div
        class="bg-white border mx-auto max-w-[650px] w-[70%] p-5 relative border-gray-300 flex-shrink-0 flex-grow-0 mb-6">
        <div class="flex justify-between">
            <div class="flex flex-row">
                <div>
                    <img src="{{ asset('storage/' . ($post->user->profile ?? 'profile.png')) }}" alt="Profile"
                        class="w-10 h-10 rounded-full object-cover">
                </div>
                <div class="px-4">
                    <h3 class="font-bold">{{ $post->user->username }}</h3>
                    <span class="text-xs text-gray-500">{{ $post->created_at->diffForHumans() }}</span>
                    <p class="text-sm text-justify">{{ $post->content }}</p>
                </div>
            </div>
            <!-- Dropdown Button -->
            <div class="relative">
                <button type="button" class="text-xl cursor-pointer px-2"
                    onclick="toggleDropdown('dropdown{{ $post->id }}', event)" aria-haspopup="true"
                    aria-expanded="false">
                    •••
                </button>
                <div id="dropdown{{ $post->id }}"
                    class="dropdown-content absolute right-0 mt-2 min-w-[150px] bg-white border border-gray-200 rounded-lg shadow-lg z-50"
                    style="display:none" onclick="event.stopPropagation()">
                    <!-- Edit Post Option -->
                    <button type="button"
                        class="w-full flex items-center gap-2 px-4 py-2 text-sm text-blue-600 hover:bg-blue-50 transition rounded-t"
                        onclick="event.stopPropagation(); openEditModal({{ $post->id }}, '{{ addslashes(e($post->content)) }}', '{{ asset('storage/' . ($post->img_content ?? '')) }}')">
                        <i class="fa-solid fa-pen-to-square"></i>
                        Edit Post
                    </button>
                    <!-- Divider -->
                    <div class="border-t border-gray-100"></div>
                    <!-- Delete Post Option -->
                    <form id="deleteForm{{ $post->id }}" action="{{ route('posts.destroy', $post->id) }}"
                        method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="w-full flex items-center gap-2 px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition rounded-b"
                            title="Delete">
                            <i class="fa-solid fa-trash-can cursor-pointer"></i>
                            Delete Post
                        </button>
                    </form>
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
                <span class="material-symbols-outlined text-2xl text-gray-700 cursor-pointer">mode_comment</span>
                <span
                    class="material-symbols-outlined text-2xl text-gray-700 cursor-pointer bookmark-icon">bookmark</span>
            </div>
        </div>
    </div>
@endforeach

<!-- Modal -->
<div id="editModal" class="hidden fixed inset-0 backdrop-blur-sm flex items-center justify-center z-50">
    <div class="bg-white rounded-[20px] shadow-lg w-full max-w-3xl flex flex-col">
        <!-- Header -->
        <div class="flex items-center justify-between border-b px-6 py-3">
            <button type="button" onclick="closeEditModal()"
                class="text-lg font-semibold text-gray-700 cursor-pointer">Cancel</button>
            <span class="font-bold text-lg">Edit Post</span>
            <button type="submit" form="editForm"
                class="text-blue-500 font-semibold text-lg cursor-pointer">Done</button>
        </div>
        <!-- Content -->
        <div class="flex flex-row h-[400px]">
            <!-- Left: Image -->
            <div class="flex-1 flex flex-col items-center bg-gray-100 rounded-bl-[20px] p-4">
                <img id="editImagePreview" src="" alt="Post image"
                    class="w-full h-[220px] object-cover rounded-lg mb-4" />
                <div id="editImageAlert" class="text-red-500 text-sm mt-2" style="display:none;"></div>
            </div>
            <!-- Right: User, Textarea -->
            <div class="flex-1 flex flex-col px-6 py-4">
                <div class="flex items-center gap-3 mb-2">
                    <img src="{{ asset('storage/' . (Auth::user()->profile ?? 'profile.png')) }}" alt="Profile"
                        class="w-10 h-10 rounded-full object-cover" />
                    <span class="font-bold">{{ Auth::user()->username }}</span>
                </div>
                <form id="editForm" method="POST" enctype="multipart/form-data" class="flex-1 flex flex-col">
                    @csrf
                    @method('PUT')
                    <textarea name="content" id="editContent" maxlength="2200"
                        class="flex-1 w-full border-none outline-none resize-none text-base font-normal bg-transparent"
                        placeholder="Edit your post..."></textarea>
                </form>
            </div>
        </div>
        <!-- Footer: Actions and Counter -->
        <div class="flex items-center justify-between px-8 py-3 border-t">
            <div class="flex items-center gap-6">
                <form id="deleteForm" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-500 hover:text-red-700 text-2xl" title="Delete">
                        <i class="fa-solid fa-trash-can cursor-pointer"></i>
                    </button>
                </form>
                <button type="button" title="Edit Image" class="text-2xl text-gray-600 hover:text-blue-500"
                    onclick="document.getElementById('editImageInput').click();">
                    <i class="fa-solid fa-pen-to-square cursor-pointer"></i>
                </button>
                <input type="file" id="editImageInput" name="image" accept="image/*" class="hidden"
                    form="editForm" />
            </div>
            <div class="flex items-center gap-2">
                <img src="{{ asset('img/QuackIcon.png') }}" alt="Quack" class="h-6 w-6 cursor-pointer" />
                <span id="charCount" class="text-gray-400 text-sm">0/2200</span>
            </div>
        </div>
    </div>
</div>
<script>
    window.LIKE_ICON = "{{ asset('img/QuackIcon.png') }}";
    window.LIKE_CLICKED_ICON = "{{ asset('img/QuackClicked.jpg') }}";
    window.QUACK_SOUND = "{{ asset('sounds/quack.mp3') }}";
    window.CSRF_TOKEN = "{{ csrf_token() }}";

    let currentOpenDropdown = null;

    // --- Dropdown Functions ---
    function toggleDropdown(id) {
        const dropdown = document.getElementById(id);

        // Close any open dropdowns
        if (currentOpenDropdown && currentOpenDropdown !== dropdown) {
            currentOpenDropdown.style.display = 'none';
        }

        // Toggle current dropdown
        if (dropdown.style.display === 'block') {
            dropdown.style.display = 'none';
            currentOpenDropdown = null;
            document.removeEventListener('click', outsideClickListener);
        } else {
            dropdown.style.display = 'block';
            currentOpenDropdown = dropdown;
            document.addEventListener('click', outsideClickListener);
        }
    }

    function outsideClickListener(event) {
        if (
            !event.target.closest('.dropdown-content') &&
            !event.target.closest('button[aria-haspopup="true"]')
        ) {
            if (currentOpenDropdown) {
                currentOpenDropdown.style.display = 'none';
                currentOpenDropdown = null;
                document.removeEventListener('click', outsideClickListener);
            }
        }
    }
</script>
