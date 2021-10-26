@extends('layouts.app')

@section('content')
<div class="main-panel">
    <div class="content">
        <div class="container-fluid">
            <h4 class="page-title">Data Resep</h4>
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card-title">Data Resep</div>
                        </div>
                        <div class="col-md-1 mt-2">
                            @if (Request::query('search'))
                            <a href="{{ route('resep.index') }}">Reset</a>
                            @endif
                        </div>
                        <div class="col-md-5">
                            <form class="navbar-left navbar-form nav-search mr-md-3" action="{{ route('resep.index') }}" method="get">
                                <div class="input-group">
                                    <input type="text" placeholder="Cari ..." name="search" class="form-control">
                                    <div class="input-group-append">
                                        <span class="input-group-text">
                                            <i class="la la-search search-icon"></i>
                                        </span>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <x-alert/>
                    <a href="{{ route('resep.create') }}" class="btn btn-dark">Tambah Resep</a>
                    <table class="table mt-4 data-table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nama Resep</th>
                                <th scope="col">Kategori</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $num = 1; @endphp
                            @forelse ($resep->data as $item)
                            <tr>
                                <td>{{$num++}}</td>
                                <td>{{$item->nama}}</td>
                                <td>{{$item->kategori->kategori}}</td>
                                <td>
                                    <form action="{{ route('resep.destroy', $item->id) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <a href="{{ route('resep.show', $item->id) }}" class="btn btn-success">Lihat</a>
                                        <input type="submit" class="btn btn-danger" onclick="return confirm('Hapus Data ini ?');" value="Hapus">
                                    </form>
                                </td>
                            </tr>
                            @empty
                                <tr>
                                    <td>Tidak ada data</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            </div>
        </div>
    </div>
</div>
@endsection