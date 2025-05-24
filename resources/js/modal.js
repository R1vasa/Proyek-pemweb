
        // --- Edit Modal Functions ---
        window.openEditModal = function(postId, content = '', imageUrl = '') {
            document.getElementById('editModal').classList.remove('hidden');
            document.getElementById('editForm').action = '/posts/' + postId;
            document.getElementById('deleteForm').action = '/posts/' + postId;
            document.getElementById('editContent').value = content;
            document.getElementById('charCount').innerText = content.length + '/2200';
            if (imageUrl) document.getElementById('editImagePreview').src = imageUrl;
        };

        window.closeEditModal = function() {
            document.getElementById('editModal').classList.add('hidden');
        };

        // --- DOMContentLoaded: UI Interactions ---
        document.addEventListener('DOMContentLoaded', function() {
            // Char counter for edit modal
            var editContent = document.getElementById('editContent');
            if (editContent) {
                editContent.addEventListener('input', function() {
                    document.getElementById('charCount').innerText = this.value.length + '/2200';
                });
            }

            // Image preview for edit + size alert
            var editImageInput = document.getElementById('editImageInput');
            var editImageAlert = document.getElementById('editImageAlert');
            if (editImageInput) {
                editImageInput.addEventListener('change', function(event) {
                    const [file] = event.target.files;
                    if (file) {
                        if (file.size > 2 * 1024 * 1024) { // 2MB
                            editImageAlert.textContent = 'Ukuran gambar maksimal 2MB!';
                            editImageAlert.style.display = 'block';
                            event.target.value = '';
                            document.getElementById('editImagePreview').src = '';
                            return;
                        } else {
                            editImageAlert.textContent = '';
                            editImageAlert.style.display = 'none';
                        }
                        document.getElementById('editImagePreview').src = URL.createObjectURL(file);
                    } else {
                        editImageAlert.textContent = '';
                        editImageAlert.style.display = 'none';
                    }
                });
            }

            // Bookmark icon animation and color
            document.querySelectorAll('.bookmark-icon').forEach(function(icon) {
                icon.addEventListener('click', function() {
                    this.classList.toggle('bookmark-active');
                    this.classList.remove('bookmark-animate');
                    void this.offsetWidth;
                    this.classList.add('bookmark-animate');
                });
            });

            // Format all like counts on page load
            document.querySelectorAll('[class^="like-count-"]').forEach(span => {
                const num = parseInt(span.textContent.replace(/\D/g, ''), 10);
                if (!isNaN(num)) span.textContent = formatLikeCount(num);
            });

            // Like button handler
            document.querySelectorAll('.like-btn').forEach(btn => {
                btn.addEventListener('click', function(e) {
                    e.preventDefault();
                    const postId = this.dataset.post;
                    const countSpan = document.querySelector('.like-count-' + postId);
                    let currentCount = parseInt(countSpan.textContent.replace(/\D/g, '')) || 0;
                    const img = this.querySelector('img');
                    const isLiked = img.src.includes('QuackClicked.jpg');

                    // Play sound
                    if (window.QUACK_SOUND) {
                        const audio = new Audio(window.QUACK_SOUND);
                        audio.play();
                    }

                    // Animation
                    img.classList.remove('like-animate');
                    void img.offsetWidth;
                    img.classList.add('like-animate');

                    // Optimistic UI update
                    if (isLiked) {
                        currentCount = Math.max(0, currentCount - 1);
                        img.src = window.LIKE_ICON;
                    } else {
                        currentCount = currentCount + 1;
                        img.src = window.LIKE_CLICKED_ICON;
                    }
                    countSpan.textContent = formatLikeCount(currentCount);

                    // AJAX request
                    fetch(`/posts/${postId}/like`, {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': window.CSRF_TOKEN,
                                'Accept': 'application/json'
                            }
                        })
                        .then(res => res.json())
                        .then(data => {
                            countSpan.textContent = formatLikeCount(data.likes_count ?? 0);
                            if (data.liked) {
                                img.src = window.LIKE_CLICKED_ICON;
                            } else {
                                img.src = window.LIKE_ICON;
                            }
                        });
                });
            });
        });

        // --- Helper for like count formatting ---
        function formatLikeCount(num) {
            num = Number(num);
            if (num >= 1000000) return (num / 1000000).toFixed(1).replace(/\.0$/, '') + 'M';
            if (num >= 1000) return (num / 1000).toFixed(1).replace(/\.0$/, '') + 'K';
            return num;
        }