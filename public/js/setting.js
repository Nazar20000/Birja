function previewImage(event) {
    const photoPreview = document.getElementById('photoPreview');
    const file = event.target.files[0];
    const reader = new FileReader();

    reader.onload = function(e) {
        photoPreview.src = e.target.result;
    }

    if (file) {
        reader.readAsDataURL(file);
    } else {
        photoPreview.src = "";
    }
}
