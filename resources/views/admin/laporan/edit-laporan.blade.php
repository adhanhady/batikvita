@extends('admin.base')
@section('content')
    <div class="section-header">
        <h1>Edit Laporan</h1>
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

<form action="{{ route('laporan.update',['id' => $laporan->id]) }}" method="post" enctype="multipart/form-data" class="form-horizontal">
    @method('PUT')
    @csrf
    <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                <h4>Edit laporan</h4>
                </div>
                <div class="card-body">

                <div class="form-group">
                    <label>nama barang</label>
                    <input type="text" name="nama_barang" class="form-control" placeholder="nama barang" required value="{{ $laporan->nama_barang}}">
                    @error('nama_barang')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label>jumlah</label>
                    <input type="number" name="jumlah" class="form-control" placeholder="jumlah" required value="{{ $laporan->jumlah}}">
                    @error('jumlah')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>


                <div class="form-group">
                    <label>Harga</label>
                    <input type="number" name="harga" class="form-control" placeholder="harga" required value="{{ $laporan->harga}}">
                    @error('harga')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Penghasilan</label>
                    <input type="number" name="penghasilan" class="form-control" placeholder="penghasilan" required value="{{ $laporan->penghasilan}}">
                    @error('penghasilan')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                    @enderror
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
