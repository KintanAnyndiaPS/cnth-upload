@extends('template/master')
@section('content')
<br>
<div class="col">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Ubah Data Dosen</h3>
        </div>
        <form action="{{ route('dosen.update', $dosen->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="card-body">
                <div class="row">
                    <div class="col col-md-12 form-group">
                        <label>Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama" value="{{$dosen->nama }}" placeholder="Masukkan">

                    </div>
                </div>
                <div class="row">
                    <div class="col col-md-12 form-group">
                        <label>NIP</label>
                        <input type="text" class="form-control" id="nip" name="nip" placeholder="Masukkan NIP" value="{{ $dosen->nip}}">
                    </div>
                </div>
                <div class="row">
                    <div class="co col-md-12 form-group">
                        <label for="exampleInputFile">Foto</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="gambar" name="gambar">
                                <label class="custom-file-label" for="exampleInputFile">Pilih Foto</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col col-md-12 form-group">
                        <label>Prodi</label>
                        <input type="text" class="form-control" id="prodi" name="prodi" placeholder="Masukkan Pekerjaan" value="{{ $dosen->prodi}}">

                    </div>
                </div>
                <div class="row">
                    <div class="col col-md-12 form-group">
                        <label>Kompetensi</label>
                        <input type="text" class="form-control" id="kompetensi" name="kompetensi" placeholder="Masukkan Pekerjaan" value="{{ $dosen->kompetensi}}">

                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>
</div>
@endsection
@section('css')
<link rel="stylesheet" href="{{ url('plugins/summernote/summernote-bs4.min.css') }}">
@endsection
@section('js')
<script src="{{ url('plugins/summernote/summernote-bs4.min.js') }}"></script>
<script>
    $(function() {
        $('#deskripsi_form').summernote()
    })
</script>
@endsection