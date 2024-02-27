@extends('admin.base')
@section('content')
<div class="section-header">
    <h1>Data Laporan</h1>
</div>
<div class="row">
    <div class="col-12">
      <div class="card">
          <div class="card-header">
            <h4>Data Laporan </h4>

              <a class="btn btn-primary" href="{{route('input-laporan')}}">Input Data</a> &nbsp;
              <a class="btn btn-danger" href="{{route('export')}}">Export <i class="fas fa-file-excel"></a></i>

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
                <th class="text-center">Jumlah</th>
                <th class="text-center">Harga</th>
                <th class="text-center">Penghasilan</th>
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
        ajax: "{{ route('show-laporan') }}",
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
                data: 'jumlah',
                name: 'jumlah'
            },
            {
                data: 'harga',
                name: 'harga'
            },
            {
                data: 'penghasilan',
                name: 'poenghasilan'
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
