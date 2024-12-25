<?php

namespace App\Http\Controllers;

use App\Imports\LaporansImport;
use App\Laporan;
use App\Barang;
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
        $barangs = Barang::all();
        return view('admin.laporan.input-laporan', compact('barangs'));
    }


    public function store(Request $request)
    {

        // dd($request);
        $request->validate ([
            'nama_barang'   => 'required',
            'jumlah'        => 'required|integer|min:1|regex:/^[0-9]+$/',
            'harga'         => 'required',
            'penghasilan'   => 'required',
            'id_barang'     => 'required',
        ]);

        // Check if stock is sufficient
        $barang = Barang::find($request->id_barang);
        if (!$barang || $barang->stok < $request->jumlah) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['jumlah' => 'Stok tidak cukup! Stok tersedia: ' . ($barang ? $barang->stok : 0)]);
        }

        DB::table('barangs')->where('id', $request->id_barang)->decrement('stok', $request->jumlah);

        DB::table('laporans')
        ->insert([
            'nama_barang'       => $request->nama_barang,
            'jumlah'            => $request->jumlah,
            'harga'             => $request->harga,
            'penghasilan'       => $request->penghasilan,
        ]);

        return redirect(route('laporan'))->with('pesan','Data Berhasil ditambahkan');

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

    public function edit($id)
    {
        $laporan = DB::table('laporans')->where('id', $id)->first();
        $barangs = DB::table('barangs')->get();
        return view('admin.laporan.edit-laporan', [
            'laporan' => $laporan,
            'barangs' => $barangs
        ]);
    }


    public function update(Request $request, $id)
    {
        $laporan = DB::table('laporans')->where('id', $id)->first();
        $oldJumlah = $laporan->jumlah;

        $request->validate ([
            'nama_barang'    => 'required',
            'jumlah'         => 'required|integer|min:1|regex:/^[0-9]+$/',
            'harga'          => 'required|integer|min:1|regex:/^[0-9]+$/',
            'penghasilan'    => 'required|integer|min:1|regex:/^[0-9]+$/',
        ]);

        // Calculate stock difference
        $jumlahDiff = $request->jumlah - $oldJumlah;
        
        // Get barang and check stock
        $barang = DB::table('barangs')->where('nama_barang', $request->nama_barang)->first();
        if ($barang->stok < $jumlahDiff) {
            return response()->json([
                'success' => false,
                'message' => 'Stok tidak mencukupi! Stok tersedia: ' . ($barang->stok + $oldJumlah)
            ]);
        }

        // Update barang stock
        DB::table('barangs')
            ->where('nama_barang', $request->nama_barang)
            ->update([
                'stok' => $barang->stok - $jumlahDiff
            ]);

        // Update laporan
        DB::table('laporans')
            ->where('id',$id)
            ->update([
                'nama_barang'       => $request->nama_barang,
                'jumlah'            => $request->jumlah,
                'harga'             => $request->harga,
                'penghasilan'       => $request->penghasilan,
            ]);

        return response()->json([
            'success' => true,
            'message' => 'Data Berhasil diupdate'
        ]);
    }

    public function destroy($id)
    {

        $laporan = DB::table('laporans')->where('id',$id)->first();
        DB::table('laporans')->where('id',$id)->delete();

        return redirect(route('laporan'))->with('pesan','Data Berhasil dihapus!');
    }

    public function massDelete(Request $request)
    {
        $ids = $request->ids;
        DB::table('laporans')->whereIn('id', $ids)->delete();
        
        return response()->json(['success' => true]);
    }

    public function export(Request $request)
	{
		return Excel::download(new LaporansImport, 'laporan.xls');


	}
}
