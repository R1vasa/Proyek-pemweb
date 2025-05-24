@extends('layout.app')

@section('title', 'Dashboard')

@push('css')
<style>
    .custom-scrollbar::-webkit-scrollbar {
        width: 6px;
    }

    .custom-scrollbar::-webkit-scrollbar-track {
        background: transparent;
    }

    .custom-scrollbar::-webkit-scrollbar-thumb {
        background-color: #facc15;
        border-radius: 10px;
    }

    body,
    html {
        margin: 0;
        padding: 0;
        width: 100%;
        height: 100%;
    }

    /* Improved dropdown styles */
    .dropdown-content {
        display: none;
        position: absolute;
        right: 0;
        background: white;
        border: 1px solid #e2e8f0;
        border-radius: 0.375rem;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        z-index: 50;
        min-width: 160px;
    }

    .dropdown-content button {
        padding: 0.5rem 1rem;
        width: 100%;
        text-align: left;
        transition: background-color 0.2s;
    }

    .dropdown-content button:hover {
        background-color: #f8fafc;
    }

    /* Improved Modal */
    #myModal {
        backdrop-filter: blur(5px);
        /* Menambahkan efek blur */
    }

    #modalContent {
        background-color: rgba(255, 255, 255, 0.9);
        /* Mengatur latar belakang modal menjadi transparan */
    }
</style>
@endpush


@section('body')
<div class="bg-white w-full h-full flex overflow-hidden">
    <x-sidebar></x-sidebar>

    <main class="flex-1 p-6 space-y-6 overflow-auto">
        <section class="border border-gray-300 rounded-md p-4 max-h-1/2 overflow-y-auto custom-scrollbar">
            <h2 class="text-xs text-black mb-3 select-none">
                User Analytics
            </h2>
            <div class="bg-[#fef7ff] rounded-md p-4 max-h-48 overflow-y-auto scrollbar-thin scrollbar-thumb-yellow-400 scrollbar-track-gray-200"
                style="scrollbar-color: #facc15 #f3f4f6">
                <ul class="space-y-3">
                    @foreach ($user as $users)
                    <li class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div
                                class="w-8 h-8 rounded-full bg-purple-200 text-purple-700 flex items-center justify-center font-semibold select-none">
                                {{ strtoupper(substr($users->username, 0, 1)) }}
                            </div>
                            <span class="text-xs text-black select-none">
                                <h2>{{ $users->username }} ({{ $users->email }})</h2>
                            </span>
                        </div>
                        <!-- Improved dropdown for actions -->
                        <div class="relative">
                            <button id="actionBtn{{ $users->id }}"
                                class="fas fa-cog text-gray-600 hover:text-gray-900 text-sm cursor-pointer transition-colors"
                                type="button" onclick="toggleDropdown('dropdown{{ $users->id }}')"
                                aria-haspopup="true" aria-expanded="false"></button>

                            <div id="dropdown{{ $users->id }}" class="dropdown-content">
                                @if ($users->isBanned())
                                <!-- Ganti dengan kondisi yang sesuai untuk memeriksa status banned -->
                                <!-- User diban -->
                                <form id="unbanForm{{ $users->id }}"
                                    action="{{ route('users.unban', $users->id) }}" method="POST"
                                    onsubmit="event.preventDefault(); showModal('Cabut Ban User', 'Apakah Anda yakin ingin mencabut ban user ini?', () => submitForm('unbanForm{{ $users->id }}'))">
                                    @csrf
                                    <button type="submit" class="text-green-600 hover:bg-green-50">
                                        <i class="fas fa-check-circle mr-2"></i>Cabut Ban
                                    </button>
                                </form>
                                <form id="deleteForm{{ $users->id }}"
                                    action="{{ route('users.destroy', $users->id) }}" method="POST"
                                    onsubmit="event.preventDefault(); showModal('Hapus User', 'Apakah Anda yakin ingin menghapus user ini?', () => submitForm('deleteForm{{ $users->id }}'))">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:bg-red-50">
                                        <i class="fas fa-trash-alt mr-2"></i>Hapus User
                                    </button>
                                </form>
                                <form id="makeAdminForm{{ $users->id }}"
                                    action="{{ route('users.makeAdmin', $users->id) }}" method="POST"
                                    onsubmit="event.preventDefault(); showModal('Jadikan Admin', 'Apakah Anda yakin ingin menjadikan user ini sebagai admin?', () => submitForm('makeAdminForm{{ $users->id }}'))">
                                    @csrf
                                    <button type="submit" class="text-blue-600 hover:bg-blue-50">
                                        <i class="fas fa-user-shield mr-2"></i>Jadikan Admin
                                    </button>
                                </form>
                                @else
                                <!-- User tidak diban -->
                                <form id="banForm{{ $users->id }}"
                                    action="{{ route('users.ban', $users->id) }}" method="POST"
                                    onsubmit="event.preventDefault(); showModal('Ban User', 'Apakah Anda yakin ingin membanned user ini?', () => submitForm('banForm{{ $users->id }}'))">
                                    @csrf
                                    <button type="submit" class="text-yellow-600 hover:bg-yellow-50">
                                        <i class="fas fa-ban mr-2"></i>Ban User
                                    </button>
                                </form>
                                <form id="makeAdminForm{{ $users->id }}"
                                    action="{{ route('users.makeAdmin', $users->id) }}" method="POST"
                                    onsubmit="event.preventDefault(); showModal('Jadikan Admin', 'Apakah Anda yakin ingin menjadikan user ini sebagai admin?', () => submitForm('makeAdminForm{{ $users->id }}'))">
                                    @csrf
                                    <button type="submit" class="text-blue-600 hover:bg-blue-50">
                                        <i class="fas fa-user-shield mr-2"></i>Jadikan Admin
                                    </button>
                                </form>
                                <form id="deleteForm{{ $users->id }}"
                                    action="{{ route('users.destroy', $users->id) }}" method="POST"
                                    onsubmit="event.preventDefault(); showModal('Hapus User', 'Apakah Anda yakin ingin menghapus user ini?', () => submitForm('deleteForm{{ $users->id }}'))">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:bg-red-50">
                                        <i class="fas fa-trash-alt mr-2"></i>Hapus User
                                    </button>
                                </form>
                                @endif
                            </div>
                        </div>
                    </li>
                    @endforeach
                </ul>

        </section>

        <section class="border border-gray-300 rounded-md p-4">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xs text-black select-none">Traffic Analytics</h2>
            </div>
            <div class="flex gap-4 w-full justify-between">
                <div class="bg-[#f7fce9] rounded-md px-4 py-3 text-center w-full">
                    <p class="text-[10px] text-black mb-1 select-none">
                        concurrent active users
                    </p>
                    <p class="font-bold text-lg text-black select-none">
                        {{ $totalUsers }}
                    </p>
                </div>
                <div class="bg-[#f7fce9] rounded-md px-4 py-3 text-center w-full">
                    <p class="text-[10px] text-black mb-1 select-none">
                        Total Users
                    </p>
                    <p class="font-bold text-lg text-black select-none">
                        {{ $totalUsers }}
                    </p>
                </div>
                <div class="bg-[#f7fce9] rounded-md px-4 py-3 text-center w-full">
                    <p class="text-[10px] text-black mb-0 select-none">
                        Avg Visit Duration
                    </p>
                    <p class="font-bold text-lg text-black select-none">
                        12:03
                    </p>
                    <p class="text-[10px] text-green-500 font-semibold select-none">
                    </p>
                </div>
            </div>
            <h2 class="text-xs text-right text-black select-none cursor-pointer hover:underline">
                view more
            </h2>
        </section>
    </main>
</div>

<!-- Improved Modal -->
<div id="myModal" class="fixed inset-0 backdrop-blur-sm bg-black/30 flex items-center justify-center z-50 hidden">
    <div class="absolute inset-0 bg-black/30 bg-opacity-30"></div> <!-- Latar belakang transparan -->
    <div id="modalContent"
        class="relative bg-white rounded-lg p-6 max-w-md w-full transform transition-all duration-300 opacity-0 scale-95">
        <h2 class="text-xl font-bold mb-4" id="modalTitle">Modal Title</h2>
        <p id="modalMessage" class="mb-4"></p>
        <div class="mt-6 flex justify-end space-x-2">
            <button id="closeModal"
                class="px-4 py-2 bg-gray-300 text-gray-800 rounded hover:bg-gray-400 transition">Tidak</button>
            <button id="confirmAction"
                class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 transition">Iya</button>
        </div>
    </div>
</div>

<script>
    // Track current open dropdown and modal callback
    let currentOpenDropdown = null;
    let currentConfirmCallback = null;
    let outsideClickHandler = null;

    // Dropdown functions
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
        if (!event.target.closest('.dropdown-content') &&
            !event.target.closest('[id^=actionBtn]')) {
            if (currentOpenDropdown) {
                currentOpenDropdown.style.display = 'none';
                currentOpenDropdown = null;
                document.removeEventListener('click', outsideClickListener);
            }
        }
    }

    // Modal functions
    function showModal(title, message, confirmCallback) {
        const myModal = document.getElementById("myModal");
        const modalContent = document.getElementById("modalContent");

        // Set modal content
        document.getElementById("modalTitle").textContent = title;
        document.getElementById("modalMessage").textContent = message;

        // Store callback
        currentConfirmCallback = confirmCallback;

        // Show modal
        myModal.classList.remove("hidden");

        // Animate in
        setTimeout(() => {
            modalContent.classList.remove("opacity-0", "scale-95");
            modalContent.classList.add("opacity-100", "scale-100");
        }, 10);
    }

    function closeModal() {
        const myModal = document.getElementById("myModal");
        const modalContent = document.getElementById("modalContent");

        // Animate out
        modalContent.classList.remove("opacity-100", "scale-100");
        modalContent.classList.add("opacity-0", "scale-95");

        // Hide after animation
        setTimeout(() => {
            myModal.classList.add("hidden");
            currentConfirmCallback = null;
        }, 300);
    }

    // Form submission handler
    function submitForm(formId) {
        const form = document.getElementById(formId);
        if (form) {
            form.submit();
        }
    }

    // Event listeners
    document.addEventListener('DOMContentLoaded', () => {
        // Modal events
        document.getElementById("closeModal").addEventListener("click", closeModal);
        document.getElementById("confirmAction").addEventListener("click", () => {
            if (currentConfirmCallback) {
                currentConfirmCallback();
            }
            closeModal();
        });

        // Close modal when clicking on backdrop
        document.getElementById("myModal").addEventListener("click", (e) => {
            if (e.target === document.getElementById("myModal")) {
                closeModal();
            }
        });

        // Close dropdowns when clicking outside
        document.addEventListener('click', (e) => {
            if (currentOpenDropdown &&
                !e.target.closest('.dropdown-content') &&
                !e.target.closest('[id^=actionBtn]')) {
                currentOpenDropdown.style.display = 'none';
                currentOpenDropdown = null;
            }
        });
    });
</script>
@endsection