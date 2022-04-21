@extends('mahasiswa.layout')

@section('content')
    <div class="container mt-5">

        <div class="row justify-content-center align-items-center">
            <div class="card" style="width: 24rem;">
                <div class="card-header">
                    Tambah Mahasiswa
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <strong>Whoops!</strong> There were some problems with your input.<br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form method="post" action="{{ route('mahasiswa.store') }}" id="myForm">
                        @csrf
                        <div class="form-group">
                            <label for="Nim">Nim</label>
                            <input autocomplete="off" type="text" name="nim" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="Nama">Nama</label>
                            <input autocomplete="off" type="text" name="nama" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="Kelas">Kelas</label>
                            <input autocomplete="off" type="text" name="kelas" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="Jurusan">Jurusan</label>
                            <input autocomplete="off" type="text" name="jurusan" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="Jurusan">Email</label>
                            <input autocomplete="off" type="text" name="email" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="Jurusan">Alamat</label>
                            <input autocomplete="off" type="text" name="alamat" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="Jurusan">Tanggal Lahir</label>
                            <input autocomplete="off" type="date" name="tanggal_lahir" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection