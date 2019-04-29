<?php

namespace App\Http\Controllers;

use App\Model\LaporanJasa;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class LaporanJasaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('laporan.jasa.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('laporan.jasa.create');
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
            'tanggal_jasa' =>'required',
            'nomor_jasa'   =>'required',
            'costumer'     =>'required',
            'harga'        =>'required',
            'keterangan'   =>'required',
            'penjelasan'   =>'required',
            'jumlah'       =>'required',
        ];

        $niceNames = [
            'tanggal_jasa' =>'Tanggal Pemesanan',
            'nomor_jasa'   =>'Nomor Pemesanan',
            'costumer'     =>'Costumer',
            'harga'        =>'Harga',
            'keterangan'   =>'Keterangan',
            'penjelasan'   =>'Penjelasan',
            'jumlah'       =>'Jumlah',
        ];

        $validator = Validator::make(Input::all(),$rules, [], $niceNames);

        if ($validator->fails()){
            return redirect()->route('laporan_jasa.create')->withInput()->withErrors($validator);
        }else{
            $field               = new LaporanJasa;
            $field->tanggal_jasa = $request->tanggal_jasa;
            $field->nomor_jasa   = $request->nomor_jasa;
            $field->costumer     = $request->costumer;
            $field->harga        = $request->harga;
            $field->nota         = $request->nota;
            $field->keterangan   = $request->keterangan;
            $field->penjelasan   = $request->penjelasan;
            $field->jumlah       = $request->jumlah;
            $field->save();
            $request->session()->flash('success', 'Jasa berhasil ditambahkan!');
            return redirect()->route("laporan_jasa.index");
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
        $laporan_jasa = LaporanJasa::find($id);
        return view('laporan.jasa.edit')->with('laporan_jasa', $laporan_jasa);
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
            'tanggal_jasa' =>'required',
            'nomor_jasa'   =>'required',
            'costumer'     =>'required',
            'harga'        =>'required',
            'keterangan'   =>'required',
            'penjelasan'   =>'required',
            'jumlah'       =>'required',
        ];

        $niceNames = [
            'tanggal_jasa' =>'Tanggal Pemesanan',
            'nomor_jasa'   =>'Nomor Pemesanan',
            'costumer'     =>'Costumer',
            'harga'        =>'Harga',
            'keterangan'   =>'Keterangan',
            'penjelasan'   =>'Penjelasan',
            'jumlah'       =>'Jumlah',
        ];

        $validator = Validator::make(Input::all(),$rules, [], $niceNames);

        if ($validator->fails()){
            return redirect()->route('laporan_jasa.create')->withInput()->withErrors($validator);
        }else{
            $field               =LaporanJasa::find($id);
            $field->tanggal_jasa = $request->tanggal_jasa;
            $field->nomor_jasa   = $request->nomor_jasa;
            $field->costumer     = $request->costumer;
            $field->harga        = $request->harga;
            $field->nota         = $request->nota;
            $field->keterangan   = $request->keterangan;
            $field->penjelasan   = $request->penjelasan;
            $field->jumlah       = $request->jumlah;
            $field->save();
            $request->session()->flash('success', 'Jasa berhasil Update!');
            return redirect()->route("laporan_jasa.index");
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
        $field = LaporanJasa::find($id);
        $field->delete();
        $request->session()->flash('success', 'Jasa berhasil dihapus!');
        return redirect()->route("laporan_jasa.index");
    }

    public function json(){
        $field = LaporanJasa::all();
        return  Datatables::of($field)
                ->addColumn('action', function ($field) {
                    return  '<a class="btn btn-xs btn-success edit " href="'.route('laporan_jasa.edit', [$field->id]).'"><i class="glyphicon glyphicon-edit"></i> Edit</a>'.
                            '<form action="'.route('laporan_jasa.destroy', [$field->id]).'" method="POST" class="pull-right" style="margin-left:10px">'.
                                method_field('DELETE').
                                csrf_field().
                                '<input type="submit" class="btn btn-xs btn-danger delete" value="Delete">'.
                            '</form>';
                })
                ->make(true);
    }
}
