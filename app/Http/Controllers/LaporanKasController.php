<?php

namespace App\Http\Controllers;

use App\Model\LaporanKas;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class LaporanKasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('laporan.kas.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('laporan.kas.create');
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
            'tanggal_kas' =>'required',
            'nomor_kas'   =>'required',
            'costumer'      =>'required',
            'harga'         =>'required',
            'nota'          =>'required',
            'jenis'         =>'required',

        ];

        $niceNames = [
            'tanggal_kas' =>'Tanggal Pemesanan',
            'nomor_kas'   =>'Nomor Pemesanan',
            'costumer'      =>'Costumer',
            'harga'         =>'Harga',
            'nota'          =>'Nota',
            'jenis'         =>'Jenis',
        ];

        $validator = Validator::make(Input::all(),$rules, [], $niceNames);

        if ($validator->fails()){
            return redirect()->route('laporan_kas.create')->withInput()->withErrors($validator);
        }else{
            $field                = new LaporanKas;
            $field->tanggal_kas = $request->tanggal_kas;
            $field->nomor_kas   = $request->nomor_kas;
            $field->costumer      = $request->costumer;
            $field->harga         = $request->harga;
            $field->nota          = $request->nota;
            $field->jenis          = $request->jenis;
            $field->save();
            $request->session()->flash('success', 'kas berhasil ditambahkan!');
            return redirect()->route("laporan_kas.index");
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
        $laporan_kas = LaporanKas::find($id);
        return view('laporan.kas.edit')->with('laporan_kas', $laporan_kas);
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
            'tanggal_kas' =>'required',
            'nomor_kas'   =>'required',
            'costumer'      =>'required',
            'harga'         =>'required',
            'nota'          =>'required',
            'jenis'         =>'required',
        ];

        $niceNames = [
            'tanggal_kas' =>'Tanggal Pemesanan',
            'nomor_kas'   =>'Nomor Pemesanan',
            'costumer'      =>'Costumer',
            'harga'         =>'Harga',
            'nota'          =>'Nota',
            'jenis'         =>'Jenis',
        ];

        $validator = Validator::make(Input::all(),$rules, [], $niceNames);

        if ($validator->fails()){
            return redirect()->route('laporan_kas.create')->withInput()->withErrors($validator);
        }else{
            $field                =LaporanKas::find($id);
            $field->tanggal_kas = $request->tanggal_kas;
            $field->nomor_kas   = $request->nomor_kas;
            $field->costumer      = $request->costumer;
            $field->harga         = $request->harga;
            $field->nota          = $request->nota;
            $field->jenis         = $request->jenis;
            $field->save();
            $request->session()->flash('success', 'kas berhasil Update!');
            return redirect()->route("laporan_kas.index");
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
        $field = LaporanKas::find($id);
        $field->delete();
        $request->session()->flash('success', 'kas berhasil dihapus!');
        return redirect()->route("laporan_kas.index");
    }

    public function json(Request $request){
        $field = LaporanKas::select('id','tanggal_kas', 'nomor_kas', 'costumer', 'nota', 'harga', 'jenis');
        return  Datatables::of($field)
                ->filter(function ($query) use ($request) {
                    if ($request->filled(['tanggal_awal','tanggal_akhir'])) {
                        $query->whereBetween('tanggal_kas', array($request->get('tanggal_awal'), $request->get('tanggal_akhir')));
                    }
                })
                ->addColumn('action', function ($field) {
                    return  '<a class="btn btn-xs btn-success edit " href="'.route('laporan_kas.edit', [$field->id]).'"><i class="glyphicon glyphicon-edit"></i> Edit</a>'.
                            '<form action="'.route('laporan_kas.destroy', [$field->id]).'" method="POST" class="pull-right" style="margin-left:10px">'.
                                method_field('DELETE').
                                csrf_field().
                                '<input type="submit" class="btn btn-xs btn-danger delete" value="Delete">'.
                            '</form>';
                })
                ->make(true);
    }
}
