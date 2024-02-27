<table>
    <thead>
        <tr>
                <th> No </th>
                <th> Nama barang </th>
                <th> Jumlah </th>
                <th> Harga </th>
                <th> Penghasilan </th>
                <th> Tanggal </th>

        </tr>
    </thead>
    <tbody>
        @foreach($laporan as $l)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $l->nama_barang}}</td>
                <td>{{ $l->jumlah}}</td>
                <td>{{ $l->harga}}</td>
                <td>{{ $l->penghasilan}}</td>
                <td>{{ $l->created_at }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
