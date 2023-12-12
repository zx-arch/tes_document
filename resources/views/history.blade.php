@extends('documents.layouts.template')
@section('container')
    
    @include('documents.components.navbar')
        <div class="p-1 my-container active-cont">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 border-bottom">
                <h1 class="h4 p-2">History</h1>
            </div>
            
            <div class="containers p-2">
            <div class="table-responsive mb-4 p-2">
                <div class="d-flex">
                    <table class="table text-nowrap mt-2 table-striped table-bordered mb-0 kv-grid-table kv-table-wrap border border-dark w-75" style="overflow-y: auto">
                        <thead>
                            <tr>
                                <td>No</td>
                                <td data-col-seq="1">Jenis Document</td>
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
                                        <td>{{$get->jenis_document}}</td>
                                        <td>{{$get->nama_document}}</td>
                                        <td>{{$get->created_at}}</td>
                                        @if ($get->created_at == $get->updated_at)
                                            <td>-</td>
                                        @else
                                            <td>{{$get->updated_at}}</td>
                                        @endif
                                        <form action="{{url('history/download_document_upload')}}" method="post">
                                            @csrf
                                            <input type="hidden" name="username" value="user_a">
                                            <input type="hidden" name="jenis_document" value="{{$get->jenis_document}}">
                                            <td>
                                                <button type="submit" class="btn btn-warning"><i class='bx bxs-download'></i> </button>
                                            </td>
                                        </form>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
            </div>

@endsection