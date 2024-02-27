@extends('admin.base')
@section('content')
<div class="section-header">
    <h1>Data Barang</h1>
</div>
<div class="row">
    <div class="col-12">
      <div class="card">
          <div class="card-header">
            <h4>Data Barang </h4>

              <a class="btn btn-primary" href="{{route('input-barang')}}">Input Data</a>

          </div>
        <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered data-table">
            <thead>
                <tr>
                <th class="text-center">
                    No
                </th>
                <th class="text-center">Nama Barang</th>
                <th class="text-center">Stok</th>
                <th class="text-center">Harga kodi</th>
                <th class="text-center">Harga satuan</th>
                <th class="text-center">foto</th>
                <th class="text-center">action</th>
                </tr>
            </thead>
            </table>
        </div>
        </div>
    </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
<script type="text/javascript">
  $(function () {

    var table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('show') }}",
        columns: [
            {
                data: 'DT_RowIndex',
                name: 'DT_RowIndex'
            },
            {
                data: 'nama_barang',
                name: 'nama_barang'
            },
            {
                data: 'stok',
                name: 'stok'
            },
            {
                data: 'harga_kodi',
                name: 'harga_kodi'
            },
            {
                data: 'harga_satuan',
                name: 'harga_atuan'
            },
            {
                data: 'foto',
                name: 'foto',
                render: function(data)
                {
                    if (data) {
                      return '<img src="' + data + '" alt="' + data + '"width="100px"/>';
                    }
                    return 'Foto Kosong';
                },
            },
            {
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false
            },
        ]
    });

  });
</script>



<script>
  $('body').on('click','.delete-confirm',function (event) {
    event.preventDefault();
    const url = $(this).attr('href');
    Swal.fire({
      title: 'Apakah Kamu Yakin ? ',
      text: "Hapus Data ini!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Ya, Hapus'
    }).then((result) => {
      if (result.value) {
        window.location.href = url;
      }
    })
  });
</script>

<script>
  $('body').on('click','.edit-confirm',function (event) {
    event.preventDefault();
    const url = $(this).attr('href');
    Swal.fire({
      title: 'Apakah Kamu Yakin ? ',
      text: "Edit Data ini!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Ya, Edit'
    }).then((result) => {
      if (result.value) {
        window.location.href = url;
      }
    })
  });
</script>

@endpush
