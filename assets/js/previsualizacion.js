document.getElementById('file').addEventListener('change', function (event) {
    const file = event.target.files[0]; // Obtén el archivo subido
    const previewElement = document.getElementById('preview');

    // Limpiar cualquier contenido anterior
    previewElement.innerHTML = '';

    if (file) {
        // Verifica si el tipo de archivo es una imagen o PDF
        if (file.type.startsWith('image/') || file.type === 'application/pdf') {
            const reader = new FileReader();

            reader.onload = function (e) {
                // Si es una imagen, mostrar la previsualización
                if (file.type.startsWith('image/')) {
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.style.maxWidth = '68%';
                    previewElement.appendChild(img);
                }
                // Si es un PDF, mostrar un mensaje indicando que se ha seleccionado un PDF
                else if (file.type === 'application/pdf') {
                    const pdfText = document.createElement('p');
                    pdfText.textContent = 'Se ha cargado el documento:';
                    previewElement.appendChild(pdfText);
                    const pdfLink = document.createElement('a');
                    const fileURL = URL.createObjectURL(file);
                    pdfLink.href = fileURL;
                    pdfLink.target = '_blank';
                    pdfLink.textContent = file.name; // Solo mostrar el nombre del archivo
                    previewElement.appendChild(pdfLink);
                }
            };

            reader.readAsDataURL(file);
        }
    }
});