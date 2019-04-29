<?php

namespace App\Http\Controllers;

use App\Model\LaporanKlise;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class LaporanKliseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('laporan.klise.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('laporan.klise.create');
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
            'tanggal_klise' =>'required',
            'nomor_klise'   =>'required',
            'costumer'      =>'required',
            'harga'         =>'required',
            'nota'          =>'required',
            'jenis'         =>'required',

        ];

        $niceNames = [
            'tanggal_klise' =>'Tanggal Pemesanan',
            'nomor_klise'   =>'Nomor Pemesanan',
            'costumer'      =>'Costumer',
            'harga'         =>'Harga',
            'nota'          =>'Nota',
            'jenis'         =>'Jenis',
        ];

        $validator = Validator::make(Input::all(),$rules, [], $niceNames);

        if ($validator->fails()){
            return redirect()->route('laporan_klise.create')->withInput()->withErrors($validator);
        }else{
            $field                = new LaporanKlise;
            $field->tanggal_klise = $request->tanggal_klise;
            $field->nomor_klise   = $request->nomor_klise;
            $field->costumer      = $request->costumer;
            $field->harga         = $request->harga;
            $field->nota          = $request->nota;
            $field->jenis          = $request->jenis;
            $field->save();
            $request->session()->flash('success', 'Klise berhasil ditambahkan!');
            return redirect()->route("laporan_klise.index");
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
        $laporan_klise = LaporanKlise::find($id);
        return view('laporan.klise.edit')->with('laporan_klise', $laporan_klise);
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
            'tanggal_klise' =>'required',
            'nomor_klise'   =>'required',
            'costumer'      =>'required',
            'harga'         =>'required',
            'nota'          =>'required',
            'jenis'         =>'required',
        ];

        $niceNames = [
            'tanggal_klise' =>'Tanggal Pemesanan',
            'nomor_klise'   =>'Nomor Pemesanan',
            'costumer'      =>'Costumer',
            'harga'         =>'Harga',
            'nota'          =>'Nota',
            'jenis'         =>'Jenis',
        ];

        $validator = Validator::make(Input::all(),$rules, [], $niceNames);

        if ($validator->fails()){
            return redirect()->route('laporan_klise.create')->withInput()->withErrors($validator);
        }else{
            $field                =LaporanKlise::find($id);
            $field->tanggal_klise = $request->tanggal_klise;
            $field->nomor_klise   = $request->nomor_klise;
            $field->costumer      = $request->costumer;
            $field->harga         = $request->harga;
            $field->nota          = $request->nota;
            $field->jenis         = $request->jenis;
            $field->save();
            $request->session()->flash('success', 'Klise berhasil Update!');
            return redirect()->route("laporan_klise.index");
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
        $field = LaporanKlise::find($id);
        $field->delete();
        $request->session()->flash('success', 'Klise berhasil dihapus!');
        return redirect()->route("laporan_klise.index");
    }

    public function json(){
        $field = LaporanKlise::all();
        return  Datatables::of($field)
                ->addColumn('action', function ($field) {
                    return  '<a class="btn btn-xs btn-success edit " href="'.route('laporan_klise.edit', [$field->id]).'"><i class="glyphicon glyphicon-edit"></i> Edit</a>'.
                            '<form action="'.route('laporan_klise.destroy', [$field->id]).'" method="POST" class="pull-right" style="margin-left:10px">'.
                                method_field('DELETE').
                                csrf_field().
                                '<input type="submit" class="btn btn-xs btn-danger delete" value="Delete">'.
                            '</form>';
                })
                ->make(true);
    }
}
