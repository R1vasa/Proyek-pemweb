// Show/hide remove image button and handle removal
const imageInput = document.getElementById('image-upload');
const removeBtn = document.getElementById('remove-image-btn');
const preview = document.getElementById('newPostImagePreview');
const box = document.getElementById('newPostImageBox');

imageInput.addEventListener('change', function(event) {
    const [file] = event.target.files;
    if (file) {
        preview.src = URL.createObjectURL(file);
        box.style.display = 'block';
        removeBtn.style.display = 'block';
    } else {
        preview.src = '';
        box.style.display = 'none';
        removeBtn.style.display = 'none';
    }
});

removeBtn.addEventListener('click', function() {
    imageInput.value = '';
    preview.src = '';
    box.style.display = 'none';
    removeBtn.style.display = 'none';
});

document.getElementById('image-upload').addEventListener('change', function(event) {
    const [file] = event.target.files;
    const preview = document.getElementById('newPostImagePreview');
    const box = document.getElementById('newPostImageBox');
    if (file) {
        preview.src = URL.createObjectURL(file);
        box.style.display = 'block';
    } else {
        preview.src = '';
        box.style.display = 'none';
    }
});