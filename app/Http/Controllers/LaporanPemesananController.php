<?php

namespace App\Http\Controllers;

use App\Model\LaporanPemesanan;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class LaporanPemesananController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('laporan.pemesanan.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('laporan.pemesanan.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'tanggal_pemesanan' =>'required',
            'nomor_pemesanan'   =>'required',
            'costumer'          =>'required',
            'no_telp'           =>'required',
        ];

        $niceNames = [
            'tanggal_pemesanan' =>'Tanggal Pemesanan',
            'nomor_pemesanan'   =>'Nomor Pemesanan',
            'costumer'          =>'Costumer',
            'no_telp'           =>'No. Telepon',
        ];

        $validator = Validator::make(Input::all(),$rules, [], $niceNames);

        if ($validator->fails()){
            return redirect()->route('laporan_pemesanan.create')->withInput()->withErrors($validator);
        }else{
            $field                    = new LaporanPemesanan;
            $field->tanggal_pemesanan = $request->tanggal_pemesanan;
            $field->nomor_pemesanan   = $request->nomor_pemesanan;
            $field->costumer          = $request->costumer;
            $field->no_telp           = $request->no_telp;
            $field->save();
            $request->session()->flash('success', 'Pemesanan berhasil ditambahkan!');
            return redirect()->route("laporan_pemesanan.index");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $laporan_pemesanan = LaporanPemesanan::find($id);
        return view('laporan.pemesanan.edit')->with('laporan_pemesanan', $laporan_pemesanan);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'tanggal_pemesanan' =>'required',
            'nomor_pemesanan'   =>'required',
            'costumer'          =>'required',
            'no_telp'           =>'required',
        ];

        $niceNames = [
            'tanggal_pemesanan' =>'Tanggal Pemesanan',
            'nomor_pemesanan'   =>'Nomor Pemesanan',
            'costumer'          =>'Costumer',
            'no_telp'           =>'No. Telepon',
        ];

        $validator = Validator::make(Input::all(),$rules, [], $niceNames);
        if ($validator->fails()){
            return redirect()->route('laporan_pemesanan.edit', $id)->withInput()->withErrors($validator);
        }else{
            $field                    = LaporanPemesanan::find($id);
            $field->tanggal_pemesanan = $request->tanggal_pemesanan;
            $field->nomor_pemesanan   = $request->nomor_pemesanan;
            $field->costumer          = $request->costumer;
            $field->no_telp           = $request->no_telp;
            $field->save();
            $request->session()->flash('success', 'Pemesanan berhasil diupdate!');
            return redirect()->route("laporan_pemesanan.index");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $field = LaporanPemesanan::find($id);
        $field->delete();
        $request->session()->flash('success', 'Pemesan berhasil dihapus!');
        return redirect()->route("laporan_pemesanan.index");
    }

    public function json(Request $request){
        $field = LaporanPemesanan::select(['tanggal_pemesanan', 'nomor_pemesanan', 'costumer', 'no_telp']);
        return  Datatables::of($field)
                ->filter(function ($query) use ($request) {
                    if ($request->filled(['tanggal_awal','tanggal_akhir'])) {
                        $query->whereBetween('tanggal_pemesanan', array($request->get('tanggal_awal'), $request->get('tanggal_akhir')));
                    }
                })
                ->addColumn('action', function ($field) {
                    return  '<a class="btn btn-xs btn-success edit " href="'.route('laporan_pemesanan.edit', [$field->id]).'"><i class="glyphicon glyphicon-edit"></i> Edit</a>'.
                            '<form action="'.route('laporan_pemesanan.destroy', [$field->id]).'" method="POST" class="pull-right" style="margin-left:10px">'.
                                method_field('DELETE').
                                csrf_field().
                                '<input type="submit" class="btn btn-xs btn-danger delete" value="Delete">'.
                            '</form>';
                })
                ->make(true);
    }
}
