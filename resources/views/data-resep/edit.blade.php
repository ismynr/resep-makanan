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
                    <form action="{{ route('resep.update', $resep->id) }}" method="post">
                        @csrf
                        @method('PUT')
                        
                        <div class="form-group">
                            <label for="kategori_id">Kategori</label>
                            {{-- <input type="kategori_id" class="form-control" name="kategori_id" value="{{$resep->kategori->kategori}}" disabled> --}}
                            <select name="kategori_id" class="form-control">
                                <option value="" disabled selected>Pilih</option>
                                @foreach ($kategori->data as $item)
                                    <option value="{{$item->id}}" @if ($resep->kategori_id == $item->id) selected @endif>{{$item->kategori}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="nama" class="form-control" name="nama" value="{{old('nama') ?? $resep->nama}}">
                        </div>
                        <div class="form-group">
                            <label for="deskripsi">Deskripsi</label>
                            <textarea name="deskripsi" cols="30" rows="5" class="form-control">{{old('deskripsi') ?? $resep->deskripsi}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="deskripsi">Bahan-bahan</label>
                            <select id="select2" class="form-control" name="bahan[]" multiple data-placeholder="Pilih">
                                @foreach($resep->bahan as $item)
                                    <option value="{{ $item->id }}" selected>{{ $item->bahan }} - {{ $item->jumlah }}</option>
                                @endforeach 
                            </select>
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

@push('js')
    <script>
        $('#select2').select2({
            placeholder: $(this).data("placeholder"),
            language: {
                noResults: function() {
                    return `<button style="width: 100%" type="button" class="btn btn-primary" 
                        onClick='task()'>+ Add New Item</button></li>`;
                }
            },
            ajax: {
                url: '{{Config::get("app.api_url")}}/api/bahan',
                dataType: 'json',
                delay: 100,
                allowClear:true,
                cache: true,
                data: function (params) { 
                    return {
                        search: params.term 
                    }
                },
                processResults: function (data) {
                    return {
                        results:  $.map(data.data, function (item) {
                            console.log(item);
                            return {
                                id: item.id,
                                text:  item.bahan+ ' - ' +item.jumlah,
                            }
                        })
                    };
                },
            },
            escapeMarkup: function (markup) {
                return markup;
            }
        });
    
        function task(){
            let bahan = prompt("Masukan Bahan", $('.select2-search__field').val());
            if (bahan) {
                let jumlah = prompt("Masukan Jumlahnya ");
                if (jumlah) {
                    $.ajax({
                        url: "{{Config::get('app.api_url')}}/api/bahan",
                        type: "POST",
                        beforeSend: function(request) {
                            request.setRequestHeader("Accept", 'application/json');
                          },
                        data: {
                            'bahan': bahan,
                            'jumlah': jumlah,
                        },
                        success: function (response) {
                            console.log(response.message);
                            $('.select2-search__field').focus();
                        },
                        error: function(e) {
                            if(e.status == 422) {
                                var errors = e.responseJSON.errors;
                                let data = [];
                                $.each(errors, function (key, value) {
                                    data += value + ' ';
                                });
                                alert(data);
                            } else {
                                alert(e.responseJSON.message);
                            }
                        }
                    });
                } else {
                    alert("Gagal Menambahkan");
                }
            } else {
                alert("Gagal Menambahkan");
            }
        }
    </script>
@endpush