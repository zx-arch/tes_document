@extends('documents.layouts.template')
@section('container')
    
    @include('documents.components.navbar')
        <div class="p-1 my-container active-cont">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 border-bottom">
                <h1 class="h4 p-2">Surat Kesepakatan Pembatalan Transaksi</h1>
            </div>
            
            <div class="containers p-2">
                <a class="btn btn-warning" href="{{ asset('template/surat_kesepakatan_pembatalan_transaksi.pdf') }}" download="Surat Kesepakatan Pembatalan Transaksi.pdf">Template</a>
                @if ((session('kode_document') != '' && Session::has('add_document_success')) || Session::has('add_barangditerima_success'))

                @else
                <div class="card border border-success mt-3" id="card-document">
                    <div class="card-header bg-success">
                        <span>Upload Document</span>
                    </div>
                    <div class="card-body">
                        <div class="update-foto w-50">
                    
                            <form action="{{ url('pembatalan_transaksi/upload/surat_pembatalan_transaksi') }}" method="post" id="update_document" class="p-2 mr-3" enctype='multipart/form-data'>
                                @csrf
                                <div class="mb-1">
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

                                <button type="submit" class="btn btn-primary mb-2">Upload</button>
                                <br>
                                <span>* file harus PDF</span><br>
                                <span>* max ukuran upload 4 MB</span>
                            </form>
                            
                            {{-- @if (Session::has('add_document_success'))
                                <p class="text-success fw-bold mt-2">{{ Session::get('add_document_success') }}</p>
                            @endif --}}
                        </div>
                    </div>
                </div>
                @endif

                @if ((session('kode_document') != '' && Session::has('add_document_success')) || Session::has('add_barangditerima_success'))
                <div class="card border border-info mt-3" id="add_barang_diterima">
                    <div class="card-header bg-info">
                        <span>Input Barang Diterima</span>
                    </div>
                    <div class="card-body">
                        <div class="update-foto w-50">
                            <p>Pada isi surat yang diupload terdapat tabel untuk menginputkan barang yang diterima di poin 1. Apabila tabel tidak cukup silakan inputkan pada form ini, anda dapat input barang beberapa kali.</p>

                            <form action="{{ url('pembatalan_transaksi/transaksi/skpt/barang_diterima') }}" method="post" class="p-2 mr-3">
                                @csrf
                                <div class="mb-1">
                                    <label for="nama">Nama barang / jasa</label>
                                    <input type="text" class="form-control mt-2" name="nama_barang" id="nama_barang"><br>
                                    
                                    <label for="qty">Qty</label>
                                    <input type="number" class="form-control mt-2 w-25" name="qty" id="qty"><br>

                                    <label for="satuan">Satuan</label>
                                    <input type="text" class="form-control mt-2 w-50" name="satuan" id="satuan"><br>

                                    <label for="harga_satuan">Harga Satuan</label>
                                    <input type="number" placeholder="contoh format: 100000" class="form-control mt-2 w-50" name="harga_satuan" id="harga_satuan"><br>

                                    <label for="jumlah">Jumlah</label>
                                    <input type="number" placeholder="contoh format: 100000" class="form-control mt-2 w-50" name="jumlah" id="jumlah">
                                    
                                    <span class="error_document text-danger p-2 mb-1"></span>
                                </div>

                                <button type="submit" class="btn btn-primary">Tambah</button>
                                <button type="button" onclick="window.location.href = `{{ url('/pembatalan_transaksi') }}`" class="btn btn-warning">Finish</button>

                            </form>
                            <p class="text-success">Note: <br>
                                <span>1. Klik 'Finish' jika tidak ada barang yang kurang</span>
                            </p>
                            @if (Session::has('add_barangditerima_success'))
                                <p class="text-success fw-bold mt-2">{{ Session::get('add_barangditerima_success') }}</p>
                            @endif

                            @if (sizeof($skpt_barang_diterima) > 0)
                                <div class="table-responsive mb-4 p-2">
                                    <div id="w0-container" class="table-responsive kv-grid-container">
                                        <table class="table text-nowrap mt-2 table-striped table-bordered mb-0 kv-grid-table kv-table-wrap w-50 border border-dark">
                                            <thead>
                                                <td>No</td>
                                                <td>Nama Barang / Jasa</td>
                                                <td>Qty</td>
                                                <td>Satuan</td>
                                                <td>Harga Satuan (Rp)</td>
                                                <td>Jumlah (Rp)</td>
                                            </thead>
                                            <tbody>
                                                @php ($count = 0)
                                                @foreach ($skpt_barang_diterima as $brng)
                                                    @php ($count++)
                                                    <tr>
                                                        <td>{{$count}}</td>
                                                        <td>{{$brng->nama_barang}}</td>
                                                        <td>{{$brng->qty}}</td>
                                                        <td>{{$brng->satuan}}</td>
                                                        <td>{{$brng->harga_satuan}}</td>
                                                        <td>{{$brng->jumlah}}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                @endif
            </div>

            {{-- @if (sizeof($getdata) > 0)

                <form action="{{url('pembatalan_transaksi')}}" method="post" id="search">
                    @csrf
                    
                    @if (Session::has('tanggal_mulai') || Session::has('tanggal_akhir'))
                        <div class="inputform" style="margin-left: 10px; display: flex; align-items: center;">
                            <div class="start">
                                <label for="tanggal_mulai">Tanggal mulai</label>
                                <input type="date" name="tanggal_mulai" id="tanggal_mulai" value="{{Session::get('tanggal_mulai')}}" class="form-control" style="width: 200px; margin-top: 5px; margin-right: 10px;">
                            </div>

                            <div class="end">
                                <label for="tanggal_akhir">Tanggal akhir</label>
                                <input type="date" name="tanggal_akhir" id="tanggal_akhir" value="{{Session::get('tanggal_akhir')}}" class="form-control" style="width: 200px; margin-top: 5px; margin-right: 10px;">
                            </div>
                            <button type="submit" class="btn btn-primary mt-3">Search</button>
                        </div>
                        
                        @php (Session::forget('tanggal_mulai'))
                        @php (Session::forget('tanggal_akhir'))
                    @else
                        <div class="inputform" style="margin-left: 10px; display: flex; align-items: center;">
                            <div class="start">
                                <label for="tanggal_mulai">Tanggal mulai</label>
                                <input type="date" name="tanggal_mulai" id="tanggal_mulai" class="form-control" style="width: 200px; margin-top: 5px; margin-right: 10px;">
                            </div>

                            <div class="end">
                                <label for="tanggal_akhir">Tanggal akhir</label>
                                <input type="date" name="tanggal_akhir" id="tanggal_akhir" class="form-control" style="width: 200px; margin-top: 5px; margin-right: 10px;">
                            </div>

                            <button type="submit" class="btn btn-primary mt-3 ml-5">Search</button>
                            
                        </div>
                    @endif
                </form>
                
                <form action="{{url('pembatalan_transaksi')}}" method="post" id="form-sorting">
                    @csrf
                    
                    @if (Session::has('sorting'))
                        @if (Session::get('sorting') == 'document_terbaru')
                            <div class="sorting ms-2" style="margin-left: auto;">
                                <select name="sorting" id="sorting" class="form-control" style="width: 200px; margin-top: 18px;">
                                    <option selected disabled value="document_terbaru">Document Terbaru</option>
                                    <option value="document_terlama">Document Terlama</option>
                                </select>
                            </div>
                            @php (Session::forget('sorting'))
                        @else
                            <div class="sorting ms-2" style="margin-left: auto;">
                                <select name="sorting" id="sorting" class="form-control" style="width: 200px; margin-top: 18px;">
                                    <option value="document_terbaru">Document Terbaru</option>
                                    <option selected disabled value="document_terlama">Document Terlama</option>
                                </select>
                            </div>
                        @php (Session::forget('sorting'))
                        @endif

                    @else
                        <div class="sorting ms-2" style="margin-left: auto;">
                            <select name="sorting" id="sorting" class="form-control border border-info" style="width: 200px; margin-top: 18px;">
                                <option selected disabled>Urutkan Berdasarkan</option>
                                <option value="document_terbaru">Document Terbaru</option>
                                <option value="document_terlama">Document Terlama</option>
                            </select>
                        </div>

                    @endif
                </form>
                
                <div class="table-responsive mb-4 p-2">
                    <div id="w0-container" class="table-responsive kv-grid-container">

                        @if (Session::has('delete_document_success'))
                            <p class="text-danger fw-bold">{{Session::get('delete_document_success')}}</p>
                        @elseif (Session::has('restore_document_success'))
                            <p class="text-success fw-bold">{{Session::get('restore_document_success')}}</p>
                        @elseif (Session::has('update_document_success'))
                            <p class="text-success fw-bold">{{Session::get('update_document_success')}}</p>
                        @elseif (Session::has('update_size_invalid'))
                            <p class="text-success fw-bold">{{Session::get('update_size_invalid')}}</p>
                        @elseif (Session::has('update_type_invalid'))
                            <p class="text-success fw-bold">{{Session::get('update_type_invalid')}}</p>
                        @endif

                        <div class="d-flex">
                            <table class="table text-nowrap mt-2 table-striped table-bordered mb-0 kv-grid-table kv-table-wrap border border-dark w-75" style="overflow-y: auto">
                                <thead>
                                    <tr>
                                        <td>No</td>
                                        <td data-col-seq="1">Kode Document</td>
                                        <td data-col-seq="2">Nama Document</td>
                                        <td data-col-seq="3">Tanggal Dibuat</td>
                                        <td data-col-seq="3">Tanggal Update</td>
                                        <td data-col-seq="3">Action</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php ($count = 0)
                                    @foreach ($getdata as $get)
                                        @php ($count++)
                                        <tr>
                                            <td>{{$count}}</td>
                                            <td>{{$get->kode_document}}</td>
                                            <td>{{$get->nama_document}}</td>
                                            <td>{{$get->created_at}}</td>
                                            <td>{{$get->updated_at}}</td>
                                            <form action="{{url('pembatalan_transaksi/download_document_upload')}}" method="post">
                                                @csrf
                                                <input type="hidden" name="user" value="{{$get->user}}">
                                                <input type="hidden" name="kode_document" value="{{$get->kode_document}}">
                                                <td>
                                                    <button type="submit" class="btn btn-warning"><i class='bx bxs-download'></i> </button>
                                                    
                                                    <a href="#" class="btn btn-secondary update_document" data-csrf = "{{csrf_token()}}" data-id="{{ $get->id }}" data-kode-document="{{ $get->kode_document }}" data-img = "{{asset('img/pdf_icon.png')}}"><i class='bx bx-edit'></i> </a>
                                                    
                                                    <a href="#" class="btn btn-danger deletetemporary" data-user="{{ $get->user }}" data-kode-document="{{ $get->kode_document }}"><i class='bx bx-trash'></i> </a>
                                                </td>
                                            </form>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            @endif
        </div>

        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script> --}}
        <script src="{{ asset('js/script.js') }}"></script>

@endsection