@extends('template/master')
@section('css')
<!-- DataTables -->

<link rel="stylesheet" href="{{ url('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">

<link rel="stylesheet" href="{{ url('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">

<link rel="stylesheet" href="{{ url('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">

@endsection
@section('content')
@if (session()->has('success'))
<div class="alert alert-primary">
    {{ session()->get('success') }}
</div>
@endif
<div class="card">
    <div class="card-header">
        <h3 class="card-title">DataTable Dosen</h3>
    </div>
    <div class="card-body">
        <a href="{{route('dosen.create')}}"><button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i>
                Tambah</button></a>

        <table id="example1" class="table table-bordered table-striped">

            <thead>
                <tr>
                    <th>Nama</th>
                    <th>NIP</th>
                    <th>Prodi</th>
                    <th>Kompetensi</th>
                    <th>Gambar</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($dosen as $data)
                <tr>
                    <td>{{ $data->nama}}</td>
                    <td>{{ $data->nip}}</td>
                    <td>{{ $data->prodi}}</td>
                    <td>{{ $data->kompetensi}}</td>
                    <td><img src="{{Storage::url('dosen/'.$data->gambar)}}" style="width:150px" class="img-thumbnail">

                    </td>
                    <td>
                        <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('dosen.destroy', $data->id) }}" method="POST">

                            @csrf
                            @method('DELETE')

                            <button type="submit" class="btn btn-outline-danger"><i class="fa fa-trash"></i></button>

                        &nbsp;
                        <a href="{{ route('dosen.edit', $data->id)}}" class="btn btn-outline-warning"><i class="fa fa-edit"></i></a>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
@section('js')
<!-- DataTables & Plugins -->
<script src="{{ url('plugins/datatables/jquery.dataTables.min.js')
}}"></script>

<script src="{{ url('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>

<script src="{{ url('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>

<script src="{{ url('plugins/datatables-responsive/js/responsive.bootstrap4.min.j') }}s"></script>

<script src="{{ url('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>

<script src="{{ url('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>

<script src="{{ url('plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ url('plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ url('plugins/pdfmake/vfs_fonts.js') }}"></script>

<script src="{{ url('plugins/datatables-
buttons/js/buttons.html5.min.js') }}"></script>

<script src="{{ url('plugins/datatables-
buttons/js/buttons.print.min.js') }}"></script>

<script src="{{ url('plugins/datatables-
buttons/js/buttons.colVis.min.js') }}"></script>


<script>
    $(function() {
        $("#example1").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print","colvis"]

        }).buttons().container().appendTo('#example1_wrapper .col-md - 6: eq(0)');
    });
</script>
@endsection
