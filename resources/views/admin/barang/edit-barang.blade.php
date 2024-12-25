@extends('admin.base')
@section('content')
    <div class="section-header">
        <h1>Edit Data Barang</h1>
    </div>

<form action="{{ route('barang.update',['id' => $barang->id]) }}" method="post" enctype="multipart/form-data" class="form-horizontal">
    @method('PUT')
    @csrf
    <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
            <div class="card">
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

                <div class="col-md-12">
                    <div class="form-group">
                        <label for=""> stok </label>
                        <input type="number" 
                            class="form-control"
                            name="stok"
                            id="stok"
                            value="{{ $barang->stok }}"
                            min="1"
                            step="1"
                            onkeydown="return event.keyCode !== 69"
                            oninput="this.value = this.value.replace(/[eE]/g, '')">
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <label for=""> harga kodi </label>
                        <input type="number" 
                            class="form-control"
                            name="harga_kodi"
                            id="harga_kodi"
                            value="{{ $barang->harga_kodi }}"
                            min="1"
                            step="1"
                            onkeydown="return event.keyCode !== 69"
                            oninput="this.value = this.value.replace(/[eE]/g, '')">
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <label for=""> harga satuan </label>
                        <input type="number" 
                            class="form-control"
                            name="harga_satuan"
                            id="harga_satuan"
                            value="{{ $barang->harga_satuan }}"
                            min="1"
                            step="1"
                            onkeydown="return event.keyCode !== 69"
                            oninput="this.value = this.value.replace(/[eE]/g, '')">
                    </div>
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
