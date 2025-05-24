@extends('layout.app')

@section('title', 'Profile')

@section('body')
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
                <button onclick="toggleModal()" class="border px-4 py-1 rounded-full">Edit Profile</button>
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

            <p class="mt-4 text-lg text-black-900">{{ Auth::user()->bio }} </p>
        </div>

        {{-- Posts user --}}
<div class="space-y-4 px-6 pb-10">
    @if($posts->count())
        @foreach($posts as $post)
        <div class="bg-white border mx-auto max-w-[650px] w-[70%] p-5 relative border-gray-300 flex-shrink-0 flex-grow-0 mb-6">
            <div class="flex justify-between">
                <div class="flex flex-row">
                    <div>
                        <img src="{{ asset('storage/' . ($post->user->profile ?? 'profile.png')) }}" alt="Profile" class="w-10 h-10 rounded-full object-cover">
                    </div>
                    <div class="px-4">
                        <h3 class="font-bold">{{ $post->user->username }}</h3>
                        <span class="text-xs text-gray-500">{{ $post->created_at ? $post->created_at->diffForHumans() : '' }}</span>
                        <p class="text-sm text-justify">{{ $post->content }}</p>
                    </div>
                </div>
                <!-- Dropdown -->
                <div class="relative">
                    <button type="button"
                        class="text-xl cursor-pointer px-2"
                        onclick="toggleDropdown('dropdown{{ $post->id }}', event)"
                        aria-haspopup="true" aria-expanded="false">
                        •••
                    </button>
                    <div id="dropdown{{ $post->id }}"
                        class="dropdown-content absolute right-0 mt-2 min-w-[150px] bg-white border border-gray-200 rounded-lg shadow-lg z-50"
                        style="display:none"
                        onclick="event.stopPropagation()">
                        <!-- Edit -->
                        <button
                            type="button"
                            class="w-full flex items-center gap-2 px-4 py-2 text-sm text-blue-600 hover:bg-blue-50 transition rounded-t"
                            onclick="event.stopPropagation(); openEditModal({{ $post->id }}, '{{ addslashes(e($post->content)) }}', '{{ asset('storage/' . ($post->img_content ?? '')) }}')">
                            <i class="fa-solid fa-pen-to-square"></i>
                            Edit Post
                        </button>
                        <div class="border-t border-gray-100"></div>
                        <!-- Delete -->
                        <form id="deleteForm{{ $post->id }}" action="{{ route('posts.destroy', $post->id) }}" method="POST" style="display:inline;">
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

            @if($post->img_content)
            <div>
                <img src="{{ asset('storage/' . $post->img_content) }}" alt="Post image" class="w-full max-w-2xs block mx-auto mt-3 rounded-lg" />
            </div>
            @endif

            <div class="flex items-center justify-between mt-4 px-2">
                <div class="flex items-center gap-2">
                    <button class="like-btn"
                        data-post="{{ $post->id }}"
                        style="background:none;border:none;outline:none;cursor:pointer;">
                        <img src="{{ $post->likes->where('user_id', Auth::id())->count() ? asset('img/QuackClicked.jpg') : asset('img/QuackIcon.png') }}"
                            alt="Like Icon"
                            class="aspect-square h-7 w-7 cursor-pointer" />
                    </button>
                    <span class="text-gray-500 text-sm font-medium ml-1 like-count-{{ $post->id }}">{{ $post->likes->count() ?? 0 }}</span>
                </div>
                <div class="flex items-center gap-4">
                    <span class="material-symbols-outlined text-2xl text-gray-700 cursor-pointer">mode_comment</span>
                    <span class="material-symbols-outlined text-2xl text-gray-700 cursor-pointer bookmark-icon">bookmark</span>
                </div>
            </div>
        </div>
        @endforeach
    @else
        <p class="text-center text-gray-500">No posts yet.</p>
    @endif

</div>
    </div>

    {{-- Sidebar kanan --}}
    <x-widget />

    <!-- Modal Edit Profile -->
    <!-- Modal Edit Akun -->
<div id="editProfileModal" class="fixed inset-0 backdrop-blur-sm bg-black/30 flex items-center justify-center z-50 hidden">
  <div class="bg-white w-full max-w-2xl rounded-3xl p-6 shadow-xl relative">
    <div class="flex justify-between items-center border-b pb-4 mb-6">
      <button onclick="toggleModal()" class="text-lg font-semibold text-black">Cancel</button>
      <h2 class="text-xl font-bold">Edit Account</h2>
      <button type="submit" form="editProfileForm" class="text-blue-500 font-semibold text-lg">Save</button>
    </div>

    <form id="editProfileForm" method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
      @csrf
      @method('PUT')

      <div class="flex items-start gap-6">
        <div class="flex flex-col items-center">
          <img id="profilePreview" src="{{ asset('storage/' . Auth::user()->profile) }}" class="w-24 h-24 rounded-full object-cover ring-2 ring-gray-300" />
          <button type="button" onclick="document.getElementById('profileInput').click()" class="text-sm text-blue-600 mt-2 hover:underline">Ubah Foto Profile</button>
          <input type="file" name="profile" id="profileInput" accept="image/*" onchange="previewImage(event)" class="hidden">
        </div>

        <div class="flex-1">
          <label class="block text-gray-700 mb-1 font-medium">Username</label>
          <input type="text" name="username" value="{{ Auth::user()->username }}" class="w-full border border-gray-300 rounded-md px-3 py-2 mb-4" />

          <label class="block text-gray-700 mb-1 font-medium">Bio</label>
          <textarea name="bio" class="w-full border border-gray-300 rounded-md px-3 py-2 h-28" placeholder="Bio">{{ Auth::user()->bio }}</textarea>
        </div>
      </div>
    </form>

    <div class="mt-8 text-center">
      <button type="button" id="showDeleteModal" class="text-red-600 font-bold text-lg hover:underline">Delete Account</button>
    </div>
  </div>
</div>

<!-- Modal Konfirmasi Hapus Akun -->
<div id="myModal" class="fixed inset-0 backdrop-blur-sm bg-black/30 flex items-center justify-center z-50 hidden">
  <div class="bg-white rounded-xl p-6 max-w-md w-full shadow-lg">
    <h2 class="text-xl font-bold mb-4">Konfirmasi Hapus Akun</h2>
    <p class="mb-4 text-gray-700">Apakah Anda yakin ingin menghapus akun Anda? Tindakan ini tidak bisa dibatalkan.</p>
    <div class="mt-6 flex justify-end gap-4">
      <button id="cancelDelete" class="px-4 py-2 bg-gray-300 text-black rounded hover:bg-gray-400">Batal</button>
      <form id="deleteAccountForm" method="POST" action="{{ route('profile.delete') }}">
        @csrf
        @method('DELETE')
        <button type="submit" id="confirmDelete" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">Ya, Hapus</button>
      </form>
    </div>
  </div>
</div>

<!--modal edit postingan -->
<div id="editModal" class="hidden fixed inset-0 backdrop-blur-sm flex items-center justify-center z-50">
        <div class="bg-white rounded-[20px] shadow-lg w-full max-w-3xl flex flex-col">
            <!-- Header -->
            <div class="flex items-center justify-between border-b px-6 py-3">
                <button type="button" onclick="closeEditModal()" class="text-lg font-semibold text-gray-700 cursor-pointer">Cancel</button>
                <span class="font-bold text-lg">Edit Post</span>
                <button type="submit" form="editForm" class="text-blue-500 font-semibold text-lg cursor-pointer">Done</button>
            </div>
            <!-- Content -->
            <div class="flex flex-row h-[400px]">
                <!-- Left: Image -->
                <div class="flex-1 flex flex-col items-center bg-gray-100 rounded-bl-[20px] p-4">
                    <img id="editImagePreview" src="" alt="Post image" class="w-full h-[220px] object-cover rounded-lg mb-4" />
                    <div id="editImageAlert" class="text-red-500 text-sm mt-2" style="display:none;"></div>
                </div>
                <!-- Right: User, Textarea -->
                <div class="flex-1 flex flex-col px-6 py-4">
                    <div class="flex items-center gap-3 mb-2">
                        <img src="{{ asset('storage/' . (Auth::user()->profile ?? 'profile.png')) }}" alt="Profile" class="w-10 h-10 rounded-full object-cover" />
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
                    <input type="file" id="editImageInput" name="image" accept="image/*" class="hidden" form="editForm" />
                </div>
                <div class="flex items-center gap-2">
                    <img src="{{ asset('img/QuackIcon.png') }}" alt="Quack" class="h-6 w-6 cursor-pointer" />
                    <span id="charCount" class="text-gray-400 text-sm">0/2200</span>
                </div>
            </div>
        </div>
        

<!-- Script -->
<script>
  let initialFormState = {
    username: '',
    bio: '',
    profileSrc: ''
  };

  function toggleModal() {
    const modal = document.getElementById('editProfileModal');
    const isHidden = modal.classList.contains('hidden');

    if (isHidden) {
      const usernameInput = document.querySelector('input[name="username"]');
      const bioTextarea = document.querySelector('textarea[name="bio"]');
      const profileImage = document.getElementById('profilePreview');

      initialFormState.username = usernameInput.value;
      initialFormState.bio = bioTextarea.value;
      initialFormState.profileSrc = profileImage.src;
    } else {
      resetFormToInitialState();
    }

    modal.classList.toggle('hidden');
  }

  function resetFormToInitialState() {
    document.querySelector('input[name="username"]').value = initialFormState.username;
    document.querySelector('textarea[name="bio"]').value = initialFormState.bio;
    document.getElementById('profilePreview').src = initialFormState.profileSrc;
    document.getElementById('profileInput').value = '';
  }

  function previewImage(event) {
    const image = document.getElementById('profilePreview');
    image.src = URL.createObjectURL(event.target.files[0]);
    image.onload = () => URL.revokeObjectURL(image.src);
  }

  const deleteModal = document.getElementById("myModal");
  const showDeleteBtn = document.getElementById("showDeleteModal");
  const cancelDeleteBtn = document.getElementById("cancelDelete");
  const confirmDeleteBtn = document.getElementById("confirmDelete");
  const deleteForm = document.getElementById("deleteAccountForm");

  showDeleteBtn.addEventListener("click", () => {
    deleteModal.classList.remove("hidden");
  });

  cancelDeleteBtn.addEventListener("click", () => {
    deleteModal.classList.add("hidden");
  });

  confirmDeleteBtn.addEventListener("click", () => {
    deleteForm.submit();
  });
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
        function openEditModal(postId, content, imageUrl) {
    // Tampilkan modal
    const modal = document.getElementById('editModal');
    modal.classList.remove('hidden');

    // Set textarea
    document.getElementById('editContent').value = content;

    // Set image
    const imagePreview = document.getElementById('editImagePreview');
    if (imageUrl && imageUrl !== 'null') {
        imagePreview.src = imageUrl;
        imagePreview.style.display = 'block';
    } else {
        imagePreview.style.display = 'none';
    }

    // Atur form action untuk submit
    const form = document.getElementById('editForm');
    form.action = `/posts/${postId}`; // Ubah sesuai route update Anda

    // Atur delete form action juga
    const deleteForm = modal.querySelector('#deleteForm');
    deleteForm.action = `/posts/${postId}`; // Ubah sesuai route delete Anda

    // Reset char count
    const charCount = document.getElementById('charCount');
    charCount.textContent = `${content.length}/2200`;
}

function closeEditModal() {
    document.getElementById('editModal').classList.add('hidden');
}
</script>
@endsection
