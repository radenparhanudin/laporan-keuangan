<?php

namespace App\Http\Controllers;

use App\Model\Product;
use App\Model\Transaction;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class Stok extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('stok.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $produks = Product::all();
        return view('stok.create', ['produks' => $produks]);
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
        ];

        $niceNames = [
            'stock'       =>'Stok Produk',
            'price'       =>'Harga Produk',
        ];

        $validator = Validator::make(Input::all(),$rules, [], $niceNames);

        if ($validator->fails()){
            return redirect()->route('stok.create')->withInput()->withErrors($validator);
             // return back()->withErrors($validator->getMessageBag()->toArray());
            // return redirect()->route('produk.create')->withErrors($validator->getMessageBag()->toArray());
        }else{
            $stok                   = new Transaction;
            $stok->product_id       = $request->id;
            $stok->type_transaction = 'purchase';
            $stok->qty              = $request->stock;
            $stok->price            = $request->price;
            $stok->total_price      = $request->price * $request->stock ;
            $stok->save();
            $request->session()->flash('success', 'Stok Produk berhasil ditambahkan!');
            return redirect()->route("stok.index");
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
        $stok = Transaction::find($id);
        return view('stok.edit')->with('stok', $stok);
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
            'qty'       =>'Stok Produk',
        ];

        $validator = Validator::make(Input::all(),$rules, [], $niceNames);

        if ($validator->fails()){
            return redirect()->route('stok.create')->withInput()->withErrors($validator);
             // return back()->withErrors($validator->getMessageBag()->toArray());
            // return redirect()->route('produk.create')->withErrors($validator->getMessageBag()->toArray());
        }else{
            $stok              = Transaction::find($id);
            $stok->qty         = $request->qty;
            $stok->price       = $request->price;
            $stok->total_price = $request->price * $request->qty;
            $stok->save();
            $request->session()->flash('success', 'Stok Produk berhasil diupdate!');
            return redirect()->route("stok.index");
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
        $stok = Transaction::find($id);
        $stok->delete();
        $request->session()->flash('success', 'Stok Produk berhasil dihapus!');
        return redirect()->route("stok.index");
    }
    public function json(){
        $stoks = Transaction::where('type_transaction', 'purchase')->get();
        return  Datatables::of($stoks)
                ->addColumn('action', function ($stoks) {
                    return  '<a class="btn btn-xs btn-success edit " href="'.url('/stok').'/'.$stoks->id.'/edit"><i class="glyphicon glyphicon-edit"></i> Edit</a>'.
                            '<form action="'.route('stok.destroy', [$stoks->id]).'" method="POST" class="pull-right" style="margin-left:10px">'.
                                method_field('DELETE').
                                csrf_field().
                                '<input type="submit" class="btn btn-xs btn-danger delete" value="Delete">'.
                            '</form>';
                })
                ->editColumn('product_id', function ($stoks){
                    return Product::find($stoks->product_id)->name;
                })
                ->editColumn('price', function ($stoks){
                    return number_format($stoks->price, 2, ',', '.');
                })
                 ->editColumn('total_price', function ($stoks){
                    return number_format($stoks->total_price, 2, ',', '.');
                })
                ->make(true);
    }
}
