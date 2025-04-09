function previewImage(event) {
    const preview = document.getElementById('preview');
    const file = event.target.files[0];
    const reader = new FileReader();

    reader.onload = function() {
        preview.src = reader.result;
        preview.style.display = 'block';
    };

    if (file) {
        reader.readAsDataURL(file);
    } else {
        // Используем атрибут data-src для исходного пути изображения
        preview.src = preview.getAttribute('data-src');
        preview.style.display = preview.src ? 'block' : 'none';
    }
}

