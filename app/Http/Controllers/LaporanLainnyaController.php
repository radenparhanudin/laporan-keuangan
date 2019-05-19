<?php

namespace App\Http\Controllers;

use App\Model\LaporanLainnya; //yang perlu di bikin modelx
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
class LaporanLainnyaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('laporan.lainnya.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('laporan.lainnya.create');
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
            'tanggal_lainnya' =>'required',
            'nomor_lainnya'   =>'required',
            'costumer'      =>'required',
            'keterangan'      =>'required',
            'harga'         =>'required',
            'nota'          =>'required',
            'jenis'         =>'required',

        ];

        $niceNames = [
            'tanggal_lainnya' =>'Tanggal Pemesanan',
            'nomor_lainnya'   =>'Nomor Pemesanan',
            'costumer'      =>'Costumer',
            'keterangan'      =>'Keterangan',
            'harga'         =>'Harga',
            'nota'          =>'Nota',
            'jenis'         =>'Jenis',
        ];

        $validator = Validator::make(Input::all(),$rules, [], $niceNames);

        if ($validator->fails()){
            return redirect()->route('laporan_lainnya.create')->withInput()->withErrors($validator);
        }else{
            $field                = new LaporanLainnya;
            $field->tanggal_lainnya = $request->tanggal_lainnya;
            $field->nomor_lainnya   = $request->nomor_lainnya;
            $field->costumer      = $request->costumer;
            $field->keterangan      = $request->keterangan;
            $field->harga         = $request->harga;
            $field->nota          = $request->nota;
            $field->jenis          = $request->jenis;
            $field->save();
            $request->session()->flash('success', 'lainnya berhasil ditambahkan!');
            return redirect()->route("laporan_lainnya.index");
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
        $laporan_lainnya = LaporanLainnya::find($id);
        return view('laporan.lainnya.edit')->with('laporan_lainnya', $laporan_lainnya);
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
            'tanggal_lainnya' =>'required',
            'nomor_lainnya'   =>'required',
            'costumer'      =>'required',//gak perlu ditambah keterangan om?
            'keterangan'      =>'required',//gak perlu ditambah keterangan om?
            'harga'         =>'required',
            'nota'          =>'required',
            'jenis'         =>'required',
        ];

        $niceNames = [
            'tanggal_lainnya' =>'Tanggal Pemesanan',
            'nomor_lainnya'   =>'Nomor Pemesanan',
            'costumer'      =>'Costumer',
            'keterangan'      =>'Keterangan',
            'harga'         =>'Harga',
            'nota'          =>'Nota',
            'jenis'         =>'Jenis',
        ];

        $validator = Validator::make(Input::all(),$rules, [], $niceNames);

        if ($validator->fails()){
            return redirect()->route('laporan_lainnya.create')->withInput()->withErrors($validator);
        }else{
            $field                =LaporanLainnya::find($id);
            $field->tanggal_lainnya = $request->tanggal_lainnya;
            $field->nomor_lainnya   = $request->nomor_lainnya;
            $field->costumer      = $request->costumer;
            $field->keterangan      = $request->keterangan;
            $field->harga         = $request->harga;
            $field->nota          = $request->nota;
            $field->jenis         = $request->jenis;
            $field->save();
            $request->session()->flash('success', 'lainnya berhasil Update!');
            return redirect()->route("laporan_lainnya.index");
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
        $field = LaporanLainnya::find($id);
        $field->delete();
        $request->session()->flash('success', 'lainnya berhasil dihapus!');
        return redirect()->route("laporan_lainnya.index");
    }

    public function json(Request $request){
        $field = LaporanLainnya::select('id','tanggal_lainnya', 'nomor_lainnya', 'costumer', 'keterangan', 'nota', 'harga', 'jenis');
        return  Datatables::of($field)
                ->filter(function ($query) use ($request) {
                    if ($request->filled(['tanggal_awal','tanggal_akhir'])) {
                        $query->whereBetween('tanggal_lainnya', array($request->get('tanggal_awal'), $request->get('tanggal_akhir')));
                    }
                })
                ->addColumn('action', function ($field) {
                    return  '<a class="btn btn-xs btn-success edit " href="'.route('laporan_lainnya.edit', [$field->id]).'"><i class="glyphicon glyphicon-edit"></i> Edit</a>'.
                            '<form action="'.route('laporan_lainnya.destroy', [$field->id]).'" method="POST" class="pull-right" style="margin-left:10px">'.
                                method_field('DELETE').
                                csrf_field().
                                '<input type="submit" class="btn btn-xs btn-danger delete" value="Delete">'.
                            '</form>';
                })
               
                ->make(true);
    }
}
