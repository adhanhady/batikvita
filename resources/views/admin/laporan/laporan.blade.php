@extends('admin.base')
@section('content')
<div class="section-header">
    <h1>Data Transaksi</h1>
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

<div class="row">
    <div class="col-12">
      <div class="card">
          <div class="card-header">
            <h4>Data Transaksi </h4>
            <div class="card-header-action">
              <a class="btn btn-primary" href="{{route('input-laporan')}}">Input Data</a> &nbsp;
              <a class="btn btn-danger" href="{{route('export')}}">Export <i class="fas fa-file-excel"></i></a> &nbsp;
              <button class="btn btn-danger" id="mass-delete" style="display: none">Delete Selected <i class="fas fa-trash"></i></button>
            </div>
          </div>
        <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered data-table">
            <thead>
                <tr>
                <th class="text-center">
                    <div class="custom-checkbox custom-control">
                        <input type="checkbox" class="custom-control-input" id="checkbox-all">
                        <label for="checkbox-all" class="custom-control-label">&nbsp;</label>
                    </div>
                </th>
                <th class="text-center">No</th>
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
                data: 'checkbox',
                name: 'checkbox',
                orderable: false,
                searchable: false,
                render: function (data, type, row) {
                    return `<div class="custom-checkbox custom-control">
                        <input type="checkbox" class="custom-control-input row-checkbox" id="checkbox-${row.id}" value="${row.id}">
                        <label for="checkbox-${row.id}" class="custom-control-label">&nbsp;</label>
                    </div>`;
                }
            },
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
                name: 'penghasilan'
            },
            {
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false
            },
        ]
    });

    // Toggle all checkboxes
    $('#checkbox-all').change(function() {
        $('.row-checkbox').prop('checked', $(this).prop('checked'));
        updateMassDeleteButton();
    });

    // Handle individual checkbox changes
    $(document).on('change', '.row-checkbox', function() {
        updateMassDeleteButton();
        // Update header checkbox
        var allChecked = $('.row-checkbox:checked').length === $('.row-checkbox').length;
        $('#checkbox-all').prop('checked', allChecked);
    });

    function updateMassDeleteButton() {
        var checkedCount = $('.row-checkbox:checked').length;
        $('#mass-delete').toggle(checkedCount > 0);
    }

    // Handle mass delete
    $('#mass-delete').click(function() {
        var selectedIds = [];
        $('.row-checkbox:checked').each(function() {
            selectedIds.push($(this).val());
        });

        if (selectedIds.length > 0) {
            Swal.fire({
                title: 'Apakah Kamu Yakin?',
                text: "Hapus " + selectedIds.length + " data yang dipilih!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: "{{ route('laporan.mass-delete') }}",
                        type: 'POST',
                        data: {
                            ids: selectedIds,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            Swal.fire(
                                'Terhapus!',
                                'Data berhasil dihapus.',
                                'success'
                            );
                            table.ajax.reload();
                            $('#checkbox-all').prop('checked', false);
                            updateMassDeleteButton();
                        },
                        error: function(error) {
                            Swal.fire(
                                'Error!',
                                'Terjadi kesalahan saat menghapus data.',
                                'error'
                            );
                        }
                    });
                }
            });
        }
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

@endpush
