@extends('documents.layouts.template')
@section('container')
    
    @include('documents.components.navbar')
        <div class="p-1 my-container active-cont">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 border-bottom">
                <h1 class="h4 p-2">Upload Document</h1>
            </div>
            
            <div class="containers p-2">
            
                <div class="card border border-success mt-3" id="card-document">
                    <div class="card-header bg-success">
                        <span>Lengkapi Form dibawah</span>
                    </div>
                    <div class="card-body">
                        <div class="update-foto w-50">
                    
                            <form action="{{ url('upload/document') }}" method="post" id="upload_document" class="p-2 mr-3" enctype='multipart/form-data'>
                                @csrf
                                <div class="mb-1">
                                    <select class="form-select" aria-label="Default select example" name="select_form" required>
                                        <option value="" disabled selected>Pilih Jenis Document</option>
                                        <option value="Document Berita Acara Negosiasi">Document Berita Acara Negosiasi</option>
                                        <option value="Surat Kesepakatan Pembatalan Transaksi">Surat Kesepakatan Pembatalan Transaksi</option>
                                        <option value="Surat Pemesanan">Surat Pemesanan</option>
                                    </select><br>

                                    <input class="form-control" name="document" type="file" id="formFile" accept=".pdf" required>
                                    
                                    <span class="error_document text-danger p-2 mb-1"></span>
                                </div>

                                <img id="pdfPreview" src="#" alt="Preview PDF" class="mb-2" style="max-width: 100%; display: none;" width="100">
                                <p id="filename" style="display: none;"></p>

                                @if (Session::has('add_type_invalid'))
                                    <p class="text-danger fw-bold">{{Session::get('type_invalid')}}</p>
                                @elseif (Session::has('add_size_invalid'))
                                    <p class="text-danger fw-bold">{{Session::get('size_invalid')}}</p>
                                @endif

                                <button type="submit" class="btn-submit btn btn-primary mb-2" style="display: block;">Upload</button>
                                <br>
                                <span>* file harus PDF</span><br>
                                <span>* max ukuran upload 300 KB</span><br>
                                <span>* jika ada salah file, harap upload ulang. File yang telah berhasil terupload dapat dilihat di halaman history</span>
                            </form>
                            @if (Session::has('add_document_success'))
                                <p class="text-success fw-bold mt-2">{{ Session::get('add_document_success') }}</p>
                            @elseif (Session::has('update_document_success'))
                                <p class="text-warning fw-bold mt-2">{{ Session::get('update_document_success') }}</p>
                            @elseif (Session::has('add_size_invalid'))
                                <p class="text-warning fw-bold mt-2">{{ Session::get('add_size_invalid') }}</p>
                            @elseif (Session::has('add_type_invalid'))
                                <p class="text-warning fw-bold mt-2">{{ Session::get('add_type_invalid') }}</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
    // Mendapatkan elemen input file
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
            if (selectedFile.size <= 307200) {
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
        </script>
@endsection