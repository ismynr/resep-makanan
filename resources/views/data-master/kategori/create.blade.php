@extends('layouts.app')

@section('content')
<div class="main-panel">
    <div class="content">
        <div class="container-fluid">
            <h4 class="page-title">Master Data</h4>
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Tambah Data Bahan</div>
                </div>
                <div class="card-body">
                    <x-alert/>
                    <form action="{{ route('kategori.store') }}" method="post">
                        @csrf
                        @method('POST')
                        
                        <div class="form-group">
                            <label for="kategori">kategori</label>
                            <input type="kategori" class="form-control" name="kategori" placeholder="Enter kategori" value="{{old('kategori')}}">
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