<?php

namespace App\Http\Controllers;

use App\Barang;
use Illuminate\Http\Request;
use DB;
use File;
use DataTables;

class BarangController extends Controller
{

    public function index()
    {
        return view('admin.barang.barang');
    }


    public function create()
    {
        return view('admin.barang.input-barang');
    }



    public function store(Request $request)
    {

        // dd($request);
        $request->validate ([
            'nama_barang'    => 'required',
            'stok'           => 'required',
            'harga_kodi'     => 'required',
            'harga_satuan'   => 'required',
            'foto'           => 'nullable|max:1000|file|image',
        ]);

        $foto = null;


        if($request->hasFile('foto')) {
            $extFile = $request->foto->getClientOriginalExtension();
            $namaFile = 'foto-'.time().".".$extFile;
            $foto = $request->foto->move('img/foto', $namaFile);
        }


        DB::table('barangs')
        ->insert([
            'nama_barang'       => $request->nama_barang,
            'stok'              => $request->stok,
            'harga_kodi'        => $request->harga_kodi,
            'harga_satuan'      => $request->harga_satuan,
            'foto'              => $foto,

        ]);

        return redirect(route('input-barang'))->with('pesan','Data Berhasil ditambahkan');

    }

    public function show(Request $request)
    {
        if ($request->ajax()) {
            $data = Barang::latest()->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){

                           $btn =
                            '<a href="'.route('barang.edit',['id' => $row->id]).'" class="btn btn-primary btn-action mr-1 edit-confirm" data-toggle="tooltip" title="" data-original-title="Edit" ><i class="fas fa-pencil-alt"></i></a>
                            <a href="'.route('barang.hapus',['id' => $row->id]).'" class="btn btn-danger btn-action trigger--fire-modal-2 delete-confirm" data-toggle="tooltip" title=""data-original-title="Delete"><i class="fas fa-trash"></i></a>
                            ';
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

        return view('admin-master.barang.barang');

    }

    public function edit($id) {
        $barang = Barang::find($id);
        return view('admin.barang.edit-barang',['barang'=>$barang]);
    }


    public function update(Request $request, $id)
    {


        $barang = Barang::find($id);
        $request->validate ([
            'nama_barang'    => 'required',
            'stok'           => 'required',
            'harga_kodi'     => 'required',
            'harga_satuan'   => 'required',
            'foto'           => 'nullable|max:1000|file|image',
        ]);

        if (isset($request->foto)) {
            $request->validate ([
                'foto '         => 'nullable',
            ]);
                if($request->hasFile('foto')) {
                    $extFile = $request->foto->getClientOriginalExtension();
                    $namaFile = 'foto-'.time().".".$extFile;
                    $foto = $request->foto->move('img/foto', $namaFile);
                }
        }



        DB::table('barangs')
            ->where('id', $id)
            ->update([
                'nama_barang'       => $request->nama_barang,
                'stok'              => $request->stok,
                'harga_kodi'        => $request->harga_kodi,
                'harga_satuan'      => $request->harga_satuan,
                'foto'              => (isset($foto) ? $foto : $barang->foto)
            ]);

        return redirect(route('barang.edit',$id))->with('pesan','Data Berhasil diupdate');

    }


    public function destroy($id)
    {

        $barang = DB::table('barangs')->where('id',$id)->first();
        if($barang->foto != 'img/foto/noimage.png') {
            File::delete($barang->foto);
        }

        DB::table('barangs')->where('id',$id)->delete();

        return redirect(route('barang'))->with('pesan','Data Berhasil dihapus!');
    }
}
