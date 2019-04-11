<?php

namespace App\Http\Controllers;

use App\Model\Product;
use App\Model\Transaction;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class Transaksi extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('transaksi.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $produks = Product::all();
        return view('transaksi.create', ['produks' => $produks]);
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
            'stock'       =>'required|numeric',
            'price'       =>'required|numeric',
            'price_sale'  =>'required|numeric',
        ];

        $niceNames = [
            'stock'       =>'Stok Produk',
            'price'       =>'Harga Produk',
            'price_sale'  =>'Harga Jual',
        ];

        $validator = Validator::make(Input::all(),$rules, [], $niceNames);

        if ($validator->fails()){
            return redirect()->route('transaksi.create')->withInput()->withErrors($validator);
             // return back()->withErrors($validator->getMessageBag()->toArray());
            // return redirect()->route('produk.create')->withErrors($validator->getMessageBag()->toArray());
        }else{
            $transaksi                   = new Transaction;
            $transaksi->product_id       = $request->id;
            $transaksi->type_transaction = 'sale';
            $transaksi->qty              = $request->stock;
            $transaksi->price            = $request->price_sale;
            $transaksi->total_price      = $request->price_sale * $request->stock ;
            $transaksi->save();
            $request->session()->flash('success', 'Stok Produk berhasil ditambahkan!');
            return redirect()->route("transaksi.index");
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $transaksi = Transaction::find($id);
        return view('transaksi.edit')->with('transaksi', $transaksi);
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
            'qty'       =>'required|numeric',
        ];

        $niceNames = [
            'qty'       =>'Stok',
        ];

        $validator = Validator::make(Input::all(),$rules, [], $niceNames);

        if ($validator->fails()){
            return redirect()->route('stok.create')->withInput()->withErrors($validator);
             // return back()->withErrors($validator->getMessageBag()->toArray());
            // return redirect()->route('produk.create')->withErrors($validator->getMessageBag()->toArray());
        }else{
            $transaksi              = Transaction::find($id);
            $transaksi->qty         = $request->qty;
            $transaksi->price       = $request->price;
            $transaksi->total_price = $request->price * $request->qty;
            $transaksi->save();
            $request->session()->flash('success', 'Transaksi berhasil diupdate!');
            return redirect()->route("transaksi.index");
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
        $transaksi = Transaction::find($id);
        $transaksi->delete();
        $request->session()->flash('success', 'Transaksi berhasil dihapus!');
        return redirect()->route("transaksi.index");
    }

    public function json(){
       $transaksis = Transaction::where('type_transaction', 'sale')->get();
        return  Datatables::of($transaksis)
                ->addColumn('action', function ($transaksis) {
                    return  '<a class="btn btn-xs btn-success edit " href="'.url('/transaksi').'/'.$transaksis->id.'/edit"><i class="glyphicon glyphicon-edit"></i> Edit</a>'.
                            '<form action="'.route('transaksi.destroy', [$transaksis->id]).'" method="POST" class="pull-right" style="margin-left:10px">'.
                                method_field('DELETE').
                                csrf_field().
                                '<input type="submit" class="btn btn-xs btn-danger delete" value="Delete">'.
                            '</form>';
                })
                ->editColumn('product_id', function ($transaksis){
                    return Product::find($transaksis->product_id)->name;
                })
                ->editColumn('price', function ($transaksis){
                    return number_format($transaksis->price, 2, ',', '.');
                })
                 ->editColumn('total_price', function ($transaksis){
                    return number_format($transaksis->total_price, 2, ',', '.');
                })
                ->make(true);
    }
}
