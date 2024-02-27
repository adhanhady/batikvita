@extends('admin.base')
@section('content')

<div class="section-header">
    <h1>Input Laporan</h1>
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
            <form action="{{ route('store-laporan') }}" method="post" enctype="multipart/form-data" class="form-horizontal">
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
                        <label for=""> jumlah </label>
                        <input type="number" class="form-control" name="jumlah" id="" value="">
                        @error('jumlah')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <label for=""> harga  </label>
                        <input type="number" class="form-control" name="harga" id="" value="">
                        @error('harga')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <label for=""> penghasilan </label>
                        <input type="number" class="form-control" name="penghasilan" id="" value="">
                        @error('penghasilan')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                        @enderror
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
