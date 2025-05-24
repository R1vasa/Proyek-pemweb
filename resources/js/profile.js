window.previewImage = function () {
    const input = document.getElementById("profile");
    const preview = document.getElementById("preview");

    const file = input.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function (e) {
            preview.src = e.target.result;
        };
        reader.readAsDataURL(file);
    }
};
