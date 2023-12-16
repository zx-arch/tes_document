document.addEventListener('DOMContentLoaded', function () {
    const fileInput = document.getElementById('formFile');
    // Mendapatkan elemen pratinjau gambar
    const pdfPreview = document.getElementById('pdfPreview');
    const filename = document.getElementById('filename');

    // Menambahkan event change pada input file
    fileInput.addEventListener('change', function (event) {
        // Mendapatkan file yang dipilih
        const selectedFile = event.target.files[0];
        console.log(selectedFile);
        // Mengecek apakah file yang dipilih adalah PDF
        if (selectedFile && selectedFile.type === 'application/pdf') {
            // Membaca file dan menetapkan sumber gambar ke pratinjau
            if (selectedFile.size <= 512000) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    pdfPreview.style.display = 'block';
                    filename.style.display = 'block';
                    filename.innerHTML = selectedFile.name;
                    pdfPreview.src = "{{ asset('img/pdf_icon.png')}}";
                    document.querySelector('.btn-submit').style.display = 'block';
                };
                reader.readAsDataURL(selectedFile);
            } else {
                filename.style.display = 'block';
                filename.classList.add('text-danger');
                filename.style.fontWeight = 'bold';
                filename.innerHTML = 'Ukuran PDF minimal 300 KB';
                document.querySelector('.btn-submit').style.display = 'none';
            }
        } else {
            // Menyembunyikan pratinjau jika file bukan PDF
            pdfPreview.style.display = 'none';
            filename.style.display = 'block';
            filename.classList.add('text-danger');
            filename.style.fontWeight = 'bold';
            filename.innerHTML = 'Jenis file tidak diijinkan';
            document.querySelector('.btn-submit').style.display = 'none';
        }
    });
});