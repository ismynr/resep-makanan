@extends('layouts.app')

@section('content')
<div class="main-panel">
    <div class="content">
        <div class="container-fluid">
            <h4 class="page-title">Master Data</h4>
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card-title">Data Bahan</div>
                        </div>
                        <div class="col-md-1 mt-2">
                            @if (Request::query('search'))
                            <a href="{{ route('bahan.index') }}">Reset</a>
                            @endif
                        </div>
                        <div class="col-md-5">
                            <form class="navbar-left navbar-form nav-search mr-md-3" action="{{ route('bahan.index') }}" method="get">
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
                    <table class="table mt-4 data-table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Bahan</th>
                                <th scope="col">Jumlah</th>
                                <th scope="col">Resep</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $num = 1; @endphp
                            @forelse ($bahan->data as $item)
                            <tr>
                                <td>{{$num++}}</td>
                                <td>{{$item->bahan}}</td>
                                <td>{{$item->jumlah}}</td>
                                <td>
                                    @foreach ($item->resep as $resep)
                                        <a href="{{ route('resep.show', $resep->id) }}" class="badge badge-dark mb-1">{{ $resep->nama }}</a> 
                                    @endforeach
                                </td>
                                <td>
                                    <form action="{{ route('bahan.destroy', $item->id) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <a href="{{ route('bahan.edit', $item->id) }}" class="btn btn-primary">Edit</a>
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