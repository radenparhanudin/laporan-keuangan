<?php

namespace App\Http\Controllers;

use App\Model\Product;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
// use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;

class Produk extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('produk.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('produk.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $post = $request->post();
        $rules = [
            'name'        =>'required|unique:products|max:100',
            'description' =>'required',
            'stock'       =>'required|numeric',
            'price'       =>'required|numeric',
        ];

        $niceNames = [
            'name'        =>'Nama Produk',
            'description' =>'Deskripsi Produk',
            'stock'       =>'Stok Produk',
            'price'       =>'Harga Produk',
        ];

        $validator = Validator::make(Input::all(),$rules, [], $niceNames);

        if ($validator->fails()){
            return redirect()->route('produk.create')->withInput()->withErrors($validator);
             // return back()->withErrors($validator->getMessageBag()->toArray());
            // return redirect()->route('produk.create')->withErrors($validator->getMessageBag()->toArray());
        }else{
            $produk              = new Product;
            $produk->name        = $request->name;
            $produk->description = $request->description;
            $produk->stock       = $request->stock;
            $produk->price       = $request->price;
            $produk->save();
            $request->session()->flash('success', 'Produk berhasil ditambahkan!');
            return redirect()->route("produk.index");
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
        $produk = Product::find($id);
        return view('produk.edit')->with('produk', $produk);
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
            'name'        =>'required',
            'description' =>'required',
            'stock'       =>'required|numeric',
            'price'       =>'required|numeric',
        ];

        $niceNames = [
            'name'        =>'Nama Produk',
            'description' =>'Deskripsi Produk',
            'stock'       =>'Stok Produk',
            'price'       =>'Harga Produk',
        ];

        $validator = Validator::make(Input::all(),$rules, [], $niceNames);

        if ($validator->fails()){
            return redirect()->route('produk.edit', $id)->withInput()->withErrors($validator);
             // return back()->withErrors($validator->getMessageBag()->toArray());
            // return redirect()->route('produk.create')->withErrors($validator->getMessageBag()->toArray());
        }else{
            $produk              = Product::find($id);
            $produk->name        = $request->name;
            $produk->description = $request->description;
            $produk->stock       = $request->stock;
            $produk->price       = $request->price;
            $produk->save();
            $request->session()->flash('success', 'Produk berhasil diupdate!');
            return redirect()->route("produk.index");
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function json(){
        $produk = Product::all();
        return  Datatables::of($produk)
                ->addColumn('action', function ($produk) {
                    return  '<a class="btn btn-xs btn-success edit" href="'.url('/produk').'/'.$produk->id.'/edit"><i class="glyphicon glyphicon-edit"></i> Edit</a>'.
                            '<a class="btn btn-xs btn-danger delete" href="'.url('/produk').'/'.$produk->id.'" style="margin-left:10px"><i class="glyphicon glyphicon-remove"></i> Hapus</a>';
                })
                ->editColumn('price', function ($produk){
                    return number_format($produk->price, 2, ",", ".");
                })
                ->make(true);
    }
}
