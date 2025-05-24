<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\Support\Facades\Auth;
?>

<div class="bg-white border mx-auto w-[70%] p-5 relative border-gray-300 flex-shrink-0 flex-grow-0 mb-0">
    <div class="flex justify-between">
        <div class="flex flex-row">
            <div>
                <img src="{{ asset('storage/' . ($comment->user->profile ?? 'profile.png')) }}" alt="Profile"
                    class="w-10 h-10 rounded-full object-cover">
            </div>
            <div class="px-4">
                <h3 class="font-bold">{{ $comment->user->username }}</h3>
                <span class="text-xs text-gray-500">{{ $comment->created_at ? $comment->created_at->diffForHumans() : '' }}</span>

                <p class="text-sm text-justify">{{ $comment->comment }}</p>
            </div>
        </div>
        <!-- Dropdown Button -->
        <div class="relative">
            <button type="button" class="text-xl cursor-pointer px-2"
                onclick="toggleDropdown('dropdown{{ $comment->id }}', event)" aria-haspopup="true" aria-expanded="false">
                •••
            </button>
            <div id="dropdown{{ $comment->id }}"
                class="dropdown-content absolute right-0 mt-2 min-w-[150px] bg-white border border-gray-200 rounded-lg shadow-lg z-50"
                style="display:none" onclick="event.stopPropagation()">
                <!-- Edit Post Option (Only for Post Owner) -->
                @if($comment->user_id === Auth::id())
                    <button type="button"
                        class="w-full flex items-center gap-2 px-4 py-2 text-sm text-blue-600 hover:bg-blue-50 transition rounded-t"
                        onclick="event.stopPropagation(); openEditModal({{ $comment->id }}, '{{ addslashes(e($comment->comment)) }}', '{{ asset('storage/' . ($comment->img_content ?? '')) }}')">
                        <i class="fa-solid fa-pen-to-square"></i>
                        Edit Post
                    </button>
                    <!-- Delete Post Option (Only for Post Owner) -->
                    <button type="button"
                        class="w-full flex items-center gap-2 px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition rounded-b"
                        onclick="event.stopPropagation(); openModal('deleteModal{{ $comment->id }}')">
                        <i class="fa-solid fa-trash-can cursor-pointer"></i>
                        Delete Post
                    </button>
                @endif
                <!-- Divider -->
                <div class="border-t border-gray-100"></div>
                <!-- Delete Post Option (Only for Admin) -->
                @if(Auth::user()->role === 'admin' && $comment->user_id !== Auth::id())
                    <button type="button"
                        class="w-full flex items-center gap-2 px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition rounded-b"
                        onclick="event.stopPropagation(); openModal('deleteModal{{ $comment->id }}')">
                        <i class="fa-solid fa-trash-can cursor-pointer"></i>
                        Delete Post
                    </button>
                @endif
            </div>
        </div>
    </div>
    </div>

    <!-- Modal Konfirmasi Hapus -->
    <div id="deleteModal{{ $comment->id }}" class="flex hidden fixed inset-0 backdrop-blur-sm flex items-center justify-center z-50">
        <div id="modalContent{{ $comment->id }}" class="bg-white rounded-lg p-6 max-w-md w-full transition-all duration-300 transform" style="opacity: 0; transform: scale(0.95)">
            <h2 class="text-xl font-bold mb-4">Konfirmasi Hapus</h2>
            <p>Apakah Anda yakin ingin menghapus postingan ini?</p>
            <div class="mt-6 flex justify-end">
                <button type="button" class="px-4 py-2 bg-gray-300 text-gray-700 rounded mr-2" onclick="closeModal('deleteModal{{ $comment->id }}')">Batal</button>
                <form id="deleteForm{{ $comment->id }}" action="{{ route('posts.destroy', $comment->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded">Hapus</button>
                </form>
            </div>
        </div>
    </div>

<!-- Modal Edit -->
<div id="editModal" class="hidden fixed inset-0 backdrop-blur-sm flex items-center justify-center z-50">
    <div class="bg-white rounded-[20px] shadow-lg w-full max-w-3xl flex flex-col">
        <!-- Header -->
        <div class="flex items-center justify-between border-b px-6 py-3">
            <button type="button" onclick="closeEditModal()"
                class="text-lg font-semibold text-gray-700 cursor-pointer">Cancel</button>
            <span class="font-bold text-lg">Edit Comment</span>
            <button type="submit" form="editForm"
                class="text-blue-500 font-semibold text-lg cursor-pointer">Done</button>
        </div>
        <!-- Content -->
        <div class="flex flex-row h-[400px]">
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
                    <textarea name="comment" id="editContent" maxlength="2200"
                        class="flex-1 w-full border-none outline-none resize-none text-base font-normal bg-transparent"
                        placeholder="Edit your comments..."></textarea>
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

    // --- Modal Functions ---
    function openModal(modalId) {
        const modal = document.getElementById(modalId);
        const modalContent = document.getElementById('modalContent' + modalId.replace('deleteModal', ''));

        modal.classList.remove('hidden');

        // Trigger reflow before animating
        modalContent.style.opacity = "0";
        modalContent.style.transform = "scale(0.95)";
        void modalContent.offsetWidth;

        modalContent.style.opacity = "1";
        modalContent.style.transform = "scale(1)";
    }

    function closeModal(modalId) {
        const modalContent = document.getElementById('modalContent' + modalId.replace('deleteModal', ''));

        modalContent.style.opacity = "0";
        modalContent.style.transform = "scale(0.95)";

        // Wait for animation to finish before hiding modal
        setTimeout(() => {
            document.getElementById(modalId).classList.add('hidden');
        }, 300); // Match with duration in Tailwind: 300ms
    }

    // Close modal if clicking outside
    window.onclick = function(event) {
        const modals = document.querySelectorAll('.modal');
        modals.forEach(modal => {
            if (event.target === modal) {
                closeModal(modal.id);
            }
        });
    }

    // --- Edit Modal Functions ---
    function openEditModal(postId, content, imageUrl) {
        const modal = document.getElementById('editModal');
        const form = document.getElementById('editForm');
        
        // Set form action
        form.action = `/posts/${postId}`;
        
        // Set content
        document.getElementById('editContent').value = content;
        
        // Set image preview
        const imgPreview = document.getElementById('editImagePreview');
        if (imageUrl) {
            imgPreview.src = imageUrl;
        } else {
            imgPreview.src = ''; // Clear if no image
        }
        
        // Show modal
        modal.classList.remove('hidden');
    }

    function closeEditModal() {
        document.getElementById('editModal').classList.add('hidden');
    }

    // Initialize character counter
    document.getElementById('editContent').addEventListener('input', function() {
        const charCount = this.value.length;
        document.getElementById('charCount').textContent = `${charCount}/2200`;
    });

    // Handle image selection for edit
    document.getElementById('editImageInput').addEventListener('change', function(e) {
        const file = e.target.files[0];
        const preview = document.getElementById('editImagePreview');
        const alert = document.getElementById('editImageAlert');
        
        if (file) {
            if (file.size > 2 * 1024 * 1024) { // 2MB limit
                alert.textContent = 'Ukuran file terlalu besar (maks 2MB)';
                alert.style.display = 'block';
                e.target.value = ''; // Clear the input
                return;
            }
            
            if (!file.type.match('image.*')) {
                alert.textContent = 'Hanya file gambar yang diizinkan';
                alert.style.display = 'block';
                e.target.value = ''; // Clear the input
                return;
            }
            
            alert.style.display = 'none';
            preview.src = URL.createObjectURL(file);
        }
    });
</script>

<style>
    .modal {
        display: flex;
        align-items: center;
        justify-content: center;
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: rgba(0, 0, 0, 0.5);
        z-index: 50;
    }

    .modal-content {
        background-color: white;
        border-radius: 8px;
        padding: 20px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }
</style>