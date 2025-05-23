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
            @if (isset($posts) && $posts->where('user_id', Auth::id())->count() > 0)
                @foreach ($posts->where('user_id', Auth::id()) as $post)
                    <x-post :post="$post" />
                @endforeach
            @else
                <div
                    class="bg-white border-1 mx-auto max-w-[650px] w-[70%] p-5 relative border-gray-300 flex-shrink-0 flex-grow-0">
                    <p class="text-center text-gray-500">You haven't created any posts yet.</p>
                </div>
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
</script>


</body>

</html>
