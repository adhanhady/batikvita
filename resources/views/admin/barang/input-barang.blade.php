    @extends('admin.base')
    @section('content')

    <div class="section-header">
        <h1>Input Data brang</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Profile</a></div>
            <div class="breadcrumb-item">Dashboard</div>
        </div>
    </div>
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
                            <input type="number" 
                            class="form-control"
                            name="stok"
                            id="stok"
                            value=""
                            min="1"
                            step="1"
                            onkeydown="return event.keyCode !== 69"
                            oninput="this.value = this.value.replace(/[eE]/g, '')">
                            {{-- @error('stok')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                            @enderror --}}
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for=""> harga kodi </label>
                            <input type="number" 
                            class="form-control"
                            name="harga_kodi"
                            id="harga_kodi"
                            value=""
                            min="1"
                            step="1"
                            onkeydown="return event.keyCode !== 69"
                            oninput="this.value = this.value.replace(/[eE]/g, '')">
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
                            <input type="number" 
                            class="form-control"
                            name="harga_satuan"
                            id="harga_satuan"
                            value=""
                            min="1"
                            step="1"
                            onkeydown="return event.keyCode !== 69"
                            oninput="this.value = this.value.replace(/[eE]/g, '')">
                            @error('harga_satuan')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>



                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-label">Foto</label>
                            <input type="file" 
                                class="form-control" 
                                name="foto" 
                                id="foto"
                                accept="image/*"
                                onchange="validateImage(this)">
                            <div class="form-text text-muted">Format yang diterima: JPG, JPEG, PNG. Maksimal 1MB</div>
                            @error('foto')
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
        <script>
            function validateImage(input) {
                const file = input.files[0];
                const fileType = file['type'];
                const validImageTypes = ['image/jpeg', 'image/jpg', 'image/png'];
                const maxSize = 1024 * 1024; // 1MB

                if (!validImageTypes.includes(fileType)) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Format File Tidak Valid',
                        text: 'Silakan pilih file gambar (JPG, JPEG, atau PNG)',
                        confirmButtonColor: '#3085d6',
                    });
                    input.value = '';
                    return false;
                }

                if (file.size > maxSize) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Ukuran File Terlalu Besar',
                        text: 'Ukuran file maksimal 1MB',
                        confirmButtonColor: '#3085d6',
                    });
                    input.value = '';
                    return false;
                }

                // Preview image
                const reader = new FileReader();
                reader.onload = function(e) {
                    if (document.getElementById('preview')) {
                        document.getElementById('preview').remove();
                    }
                    const img = document.createElement('img');
                    img.id = 'preview';
                    img.src = e.target.result;
                    img.style.maxWidth = '200px';
                    img.style.marginTop = '10px';
                    input.parentNode.appendChild(img);
                }
                reader.readAsDataURL(file);
            }
        </script>
    @endpush
