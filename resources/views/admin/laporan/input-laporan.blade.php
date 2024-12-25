@extends('admin.base')
@section('content')

<div class="section-header">
    <h1>Input Data Transaksi</h1>
     <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="#">Profile</a></div>
        <div class="breadcrumb-item">Dashboard</div>
    </div>
</div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('store-laporan') }}" method="post" enctype="multipart/form-data" class="form-horizontal">
            @csrf

                <div class="col-md-12">
                    <div class="form-group">
                        <label for=""> Nama Barang </label>
                        <select class="form-control" name="nama_barang" id="nama_barang">
                            <option value="">Pilih Barang</option>
                            @foreach($barangs as $barang)
                                <option value="{{ $barang->nama_barang }}" 
                                    data-id="{{ $barang->id }}"
                                    data-harga-satuan="{{ $barang->harga_satuan }}"
                                    data-harga-kodi="{{ $barang->harga_kodi }}"
                                    data-stok="{{ $barang->stok }}">
                                    {{ $barang->nama_barang }}
                                </option>
                            @endforeach
                        </select>
                        @error('nama_barang')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <input type="hidden" name="id_barang" id="id_barang" value="">
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <label for=""> Jumlah </label>
                        <input type="number" 
                               class="form-control" 
                               name="jumlah" 
                               id="jumlah" 
                               value=""
                               min="1"
                               step="1"
                               onkeydown="return event.keyCode !== 69"
                               oninput="this.value = this.value.replace(/[eE]/g, '')">
                        @error('jumlah')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <label for=""> Harga  </label>
                        <input type="hidden" name="harga" id="harga" value="">
                        <input type="text" class="form-control" id="harga_display" readonly>
                        @error('harga')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <label for=""> Penghasilan </label>
                        <input type="hidden" name="penghasilan" id="penghasilan" value="">
                        <input type="text" class="form-control" id="penghasilan_display" readonly>
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const namaBarangSelect = document.getElementById('nama_barang');
            const jumlahInput = document.getElementById('jumlah');
            const hargaInput = document.getElementById('harga');
            const hargaDisplay = document.getElementById('harga_display');
            const penghasilanInput = document.getElementById('penghasilan');
            const penghasilanDisplay = document.getElementById('penghasilan_display');
            const idBarangInput = document.getElementById('id_barang');

            function formatRupiah(angka) {
                return new Intl.NumberFormat('id-ID', {
                    style: 'currency',
                    currency: 'IDR',
                    minimumFractionDigits: 0,
                    maximumFractionDigits: 0
                }).format(angka);
            }

            function updateHargaAndPenghasilan() {
                const selectedOption = namaBarangSelect.options[namaBarangSelect.selectedIndex];
                const jumlah = parseInt(jumlahInput.value) || 0;
                
                if (selectedOption.value) {
                    // Update id_barang value
                    idBarangInput.value = selectedOption.dataset.id;

                    const hargaSatuan = parseFloat(selectedOption.dataset.hargaSatuan);
                    const hargaKodi = parseFloat(selectedOption.dataset.hargaKodi);
                    const stok = parseInt(selectedOption.dataset.stok) || 0;
                    
                    // Check if stock is sufficient
                    if (jumlah > stok) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Stok Tidak Cukup',
                            text: 'Stok tersedia: ' + stok,
                            confirmButtonColor: '#3085d6',
                            confirmButtonText: 'OK'
                        });
                        jumlahInput.value = '';
                        return;
                    }

                    // Use harga_kodi if jumlah >= 20, otherwise use harga_satuan
                    const harga = jumlah >= 20 ? hargaKodi : hargaSatuan;
                    const penghasilan = jumlah >= 20 ? jumlah / 20 * harga : harga * jumlah;

                    // Set actual values
                    hargaInput.value = harga;
                    penghasilanInput.value = penghasilan;

                    // Set formatted display values
                    hargaDisplay.value = formatRupiah(harga);
                    penghasilanDisplay.value = formatRupiah(penghasilan);
                } else {
                    idBarangInput.value = '';
                    hargaInput.value = '';
                    penghasilanInput.value = '';
                    hargaDisplay.value = '';
                    penghasilanDisplay.value = '';
                }
            }

            namaBarangSelect.addEventListener('change', updateHargaAndPenghasilan);
            jumlahInput.addEventListener('input', updateHargaAndPenghasilan);
        });
    </script>
@endpush
