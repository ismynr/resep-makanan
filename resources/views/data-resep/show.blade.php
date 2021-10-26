@extends('layouts.app')

@section('content')
<div class="main-panel">
    <div class="content">
        <div class="container-fluid">
            <h4 class="page-title">Data Resep</h4>
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Edit Data Resep</div>
                </div>
                <div class="card-body">
                    <x-alert/>
                    @php
                        $resep = $resep->data;
                    @endphp
                    <div class="form-group">
                        <label for="kategori_id">Kategori</label>
                        <input type="kategori_id" class="form-control" name="kategori_id" value="{{$resep->kategori->kategori}}" disabled>
                    </div>
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="nama" class="form-control" name="nama" value="{{$resep->nama}}" disabled>
                    </div>
                    <div class="form-group">
                        <label for="deskripsi">Deskripsi</label>
                        <textarea name="deskripsi" cols="30" rows="5" class="form-control" disabled>{{$resep->deskripsi}}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="bahan">Bahan</label> <br>
                        @foreach ($resep->bahan as $item)
                            <span class="badge badge-dark mb-2">{{$item->bahan}} {{$item->jumlah}}</span> <br>
                        @endforeach
                    </div>

                    <div class="form-group">
                        <a href="{{ route('resep.edit', $resep->id) }}" class="btn btn-primary float-right">Edit Resep Ini</a>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>
</div>
@endsection