@extends('documents.layouts.template')
@section('container')
    
    @include('documents.components.navbar')
        <div class="p-1 my-container active-cont">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 border-bottom">
                <h1 class="h4 p-2">Dashboard</h1>
            </div>
            <div class="containers p-2">
                <h6 class="p-2 mb-2 mt-2">Template Lampiran</h6>
                <ul class="list-group">

                    <li class="list-group-item"><a href="{{ url('pembatalan_transaksi/generate-pdf') }}" target="_blank" rel="noopener noreferrer">Surat Kesepakatan Pembatalan Transaksi</a></li>

                    <li class="list-group-item"><a href="{{url('surat_pemesanan')}}">Surat Pemesanan</a></li>
                </ul>
            </div>
        </div>

@endsection