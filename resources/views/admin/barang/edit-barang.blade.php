@extends('admin.base')
@section('content')
    <div class="section-header">
        <h1>Edit Barang</h1>
    </div>

    @if (session()->has('pesan'))
    <div class="alert alert-success alert-dismissible show fade">
    <div class="alert-body">
        <button class="close" data-dismiss="alert">
            <span>×</span>
        </button>
        {{ session()->get('pesan') }}
    </div>
    </div>
    @endif

<form action="{{ route('barang.update',['id' => $barang->id]) }}" method="post" enctype="multipart/form-data" class="form-horizontal">
    @method('PUT')
    @csrf
    <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                <h4>Edit Barang</h4>
                </div>
                <div class="card-body">

                <div class="form-group">
                    <label>nama barang</label>
                    <input type="text" name="nama_barang" class="form-control" placeholder="nama barang" required value="{{ $barang->nama_barang}}">
                    @error('nama_barang')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label>stok</label>
                    <input type="number" name="stok" class="form-control" placeholder="stok" required value="{{ $barang->stok}}">
                    @error('stok')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>


                <div class="form-group">
                    <label>Harga Kodi</label>
                    <input type="number" name="harga_kodi" class="form-control" placeholder="harga_kodi" required value="{{ $barang->harga_kodi}}">
                    @error('harga_kodi')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Harga Satuan</label>
                    <input type="number" name="harga_satuan" class="form-control" placeholder="harga_satuan" required value="{{ $barang->harga_satuan}}">
                    @error('harga_satuan')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>


                <div class="form-group">
                        <div class="form-group">
                        <label for="exampleFormControlFile1">Input Foto </label>
                        <input type="file" name="foto" class="form-control-file" id="exampleFormControlFile1" >
                            @error('foto')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                        @enderror
                        </div>
                    <div class="form-text text-muted">The image must have a maximum size of 1MB</div>
                </div>


                <div class="form-group">
                    <button class="btn btn-danger" type="reset" value="Reset">Reset</button>
                    <button class="btn btn-primary" type="submit">Input</button>
                </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection


@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
@endpush
