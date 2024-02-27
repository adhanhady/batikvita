@extends('admin.base')
@section('content')

<div class="section-header">
    <h1>Input Data brang</h1>
     <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="#">Profile</a></div>
        <div class="breadcrumb-item">Dashboard</div>
    </div>
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

    <div class="card">
        <div class="card-body">
            <form action="{{ route('store') }}" method="post" enctype="multipart/form-data" class="form-horizontal">
            @csrf

                <div class="col-md-12">
                    <div class="form-group">
                        <label for=""> Nama Barang </label>
                        <input type="text" class="form-control" name="nama_barang" id="" value="">
                        @error('nama_barang')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <label for=""> stok </label>
                        <input type="number" class="form-control" name="stok" id="" value="">
                        @error('stok')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <label for=""> harga kodi </label>
                        <input type="number" class="form-control" name="harga_kodi" id="" value="">
                        @error('harga_kodi')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <label for=""> harga satuan </label>
                        <input type="number" class="form-control" name="harga_satuan" id="" value="">
                        @error('harga_satuan')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>



                <div class="col-md-12">
                    <div class="form-group">

                        <div class="form-group">
                            <label for="exampleFormControlFile1">Input Foto</label>
                            <input type="file" name="foto" class="form-control-file" id="exampleFormControlFile1" >
                            @error('foto')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-text text-muted">The image must have a maximum size of 1MB</div>
                    </div>
                </div>


                <div class="col-md-12">
                    <button class="btn btn-danger" type="reset" value="Reset">Reset</button>
                    <button class="btn btn-primary" type="submit">Input</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
@endpush
