@extends('layouts.app')

@section('content')
<div class="main-panel">
    <div class="content">
        <div class="container-fluid">
            <h4 class="page-title">Master Data</h4>
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Edit Data Bahan</div>
                </div>
                <div class="card-body">
                    <x-alert/>
                    @php
                        $bahan = $bahan->data;
                    @endphp
                    <form action="{{ route('bahan.update', $bahan->id) }}" method="post">
                        @csrf
                        @method('PUT')
                        
                        <div class="form-group">
                            <label for="bahan">Bahan</label>
                            <input type="bahan" class="form-control" name="bahan" placeholder="Enter bahan" value="{{old('bahan') ?? $bahan->bahan}}">
                        </div>
                        <div class="form-group">
                            <label for="jumlah">Jumlah</label>
                            <input type="jumlah" class="form-control" name="jumlah" placeholder="Enter jumlah" value="{{old('jumlah') ?? $bahan->jumlah}}">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary float-right">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
            </div>
        </div>
    </div>
</div>
@endsection