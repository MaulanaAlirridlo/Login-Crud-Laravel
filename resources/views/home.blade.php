@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col">
                <h1 class="fw-bold">Selamat Datang, {{ Auth::user()->name }}</h1>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="w-100 overflow-hidden">
                    <button type="button" class="float-end btn btn-primary" data-bs-toggle="modal" data-bs-target="#formModal">
                        Tambah Data
                    </button>
                </div>
                <div class="mt-3 w-100">
                    <table id="myTable" class="table display w-100">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Kode Kebun</th>
                                <th>Nama Kebun</th>
                                <th>Luas Kebun</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $i = 1;
                            @endphp
                            @foreach ($kebun as $item)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $item->kode }}</td>
                                    <td>{{ $item->nama }}</td>
                                    <td>{{ number_format($item->luas, 0, ',', '.') }}</td>
                                    <td>
                                        <button class="btn p-0"><a href="javascript:void(0)" onclick="edit('{{ $item->kode }}')">Edit</a></button>
                                        <form action="{{ route('kebun.destroy', ['kebun'=>$item->kode]) }}" method="POST" class="d-inline">
                                            @method('delete')
                                            @csrf
                                            <button class="btn p-0 btn-href" type="submit">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="formModal" tabindex="-1" aria-labelledby="formModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('kebun.store') }}" method="POST" id="form">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="formModalLabel">Modal title</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <label for="kode" class="form-label">Kode Kebun</label>
                        <input type="text" name="kode" id="kode" class="form-control" required>
                        <label for="nama" class="form-label">Nama Kebun</label>
                        <input type="text" name="nama" id="nama" class="form-control" required>
                        <label for="luas" class="form-label">Luas Kebun</label>
                        <input type="number" name="luas" id="luas" class="form-control" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form method="POST" id="formEdit">
                @csrf
                @method('PUT')
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">Modal title</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <label for="kode" class="form-label">Kode Kebun</label>
                        <input type="text" name="kode" id="editKode" class="form-control" required>
                        <label for="nama" class="form-label">Nama Kebun</label>
                        <input type="text" name="nama" id="editNama" class="form-control" required>
                        <label for="luas" class="form-label">Luas Kebun</label>
                        <input type="number" name="luas" id="editLuas" class="form-control" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
        });

        function edit(kode) {
            $.ajax({
                url: "{{ route('kebun.edit', ['kebun' => ':kode']) }}".replace(':kode', kode),
                method: "GET",
                dataType: "json",
                success: function(data) {
                    $('#editKode').val(data.kode);
                    $('#editNama').val(data.nama);
                    $('#editLuas').val(data.luas);
                    $('#formEdit').attr("action", "{{ route('kebun.update', ['kebun'=>':kode']) }}".replace(':kode', kode));
                    $('#editModal').modal("show")
                },
                error: function(xhr, status, error) {
                    console.error("Error: " + error);
                }
            });
        }
    </script>
@endsection
