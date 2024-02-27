<?php

namespace App\Http\Controllers;

use App\Imports\LaporansImport;
use App\Laporan;
use Illuminate\Http\Request;
use DB;
use File;
use DataTables;
use Maatwebsite\Excel\Facades\Excel;



class LaporanController extends Controller
{

    public function index()
    {
        return view('admin.laporan.laporan');
    }

    public function create()
    {
        return view('admin.laporan.input-laporan');
    }


    public function store(Request $request)
    {

        // dd($request);
        $request->validate ([
            'nama_barang'   => 'required',
            'jumlah'        => 'required',
            'harga'         => 'required',
            'penghasilan'   => 'required',
        ]);


        DB::table('laporans')
        ->insert([
            'nama_barang'       => $request->nama_barang,
            'jumlah'            => $request->jumlah,
            'harga'             => $request->harga,
            'penghasilan'       => $request->penghasilan,
        ]);

        return redirect(route('input-laporan'))->with('pesan','Data Berhasil ditambahkan');

    }


    public function show(Request $request)
    {
        if ($request->ajax()) {
            $data = Laporan::latest()->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){

                           $btn =
                            '<a href="'.route('laporan.edit',['id' => $row->id]).'" class="btn btn-primary btn-action mr-1 edit-confirm" data-toggle="tooltip" title="" data-original-title="Edit" ><i class="fas fa-pencil-alt"></i></a>
                            <a href="'.route('laporan.hapus',['id' => $row->id]).'" class="btn btn-danger btn-action trigger--fire-modal-2 delete-confirm" data-toggle="tooltip" title=""data-original-title="Delete"><i class="fas fa-trash"></i></a>
                            ';
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

        return view('admin-master.laporan.laporan');

    }

    public function edit($id) {
        $laporan = laporan::find($id);
        return view('admin.laporan.edit-laporan',['laporan'=>$laporan]);
    }


    public function update(Request $request, $id)
    {


        $laporan = Laporan::find($id);
        $request->validate ([
            'nama_barang'       => 'required',
            'jumlah'            => 'required',
            'harga'             => 'required',
            'penghasilan'       => 'required',
        ]);


        DB::table('laporans')
            ->where('id', $id)
            ->update([
                'nama_barang'       => $request->nama_barang,
                'jumlah'            => $request->jumlah,
                'harga'             => $request->harga,
                'penghasilan'       => $request->penghasilan,
            ]);

        return redirect(route('laporan.edit',$id))->with('pesan','Data Berhasil diupdate');

    }

    public function destroy($id)
    {

        $laporan = DB::table('laporans')->where('id',$id)->first();
        DB::table('laporans')->where('id',$id)->delete();

        return redirect(route('laporan'))->with('pesan','Data Berhasil dihapus!');
    }


    public function export(Request $request)
	{
		return Excel::download(new LaporansImport, 'laporan.xls');


	}
}
