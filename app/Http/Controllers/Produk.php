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
        $rules = [
            'name'        =>'required|unique:products|max:100',
            'description' =>'required',
            'price'       =>'required|numeric',
            'price_sale'  =>'required|numeric',
        ];

        $niceNames = [
            'name'        =>'Nama Produk',
            'description' =>'Deskripsi Produk',
            'price'       =>'Harga Produk',
            'price_sale'  =>'Harga Jual',
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
            $produk->price       = $request->price;
            $produk->price_sale  = $request->price_sale;
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
            'price'       =>'required|numeric',
            'price_sale'  =>'required|numeric',
        ];

        $niceNames = [
            'name'        =>'Nama Produk',
            'description' =>'Deskripsi Produk',
            'price'       =>'Harga Produk',
            'price_sale'  =>'Harga Jual',
        ];

        $validator = Validator::make(Input::all(),$rules, [], $niceNames);

        if ($validator->fails()){
            return redirect()->route('produk.edit', $id)->withInput()->withErrors($validator);
        }else{
            $produk              = Product::find($id);
            $produk->name        = $request->name;
            $produk->description = $request->description;
            $produk->price       = $request->price;
            $produk->price_sale  = $request->price_sale;
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
    public function destroy(Request $request, $id)
    {
        $produk = Product::find($id);
        $produk->delete();
        $request->session()->flash('success', 'Produk berhasil dihapus!');
        return redirect()->route("produk.index");
    }

    public function json(){
        $produk = Product::all();
        return  Datatables::of($produk)
                ->addColumn('action', function ($produk) {
                    return  '<a class="btn btn-xs btn-success edit " href="'.url('/produk').'/'.$produk->id.'/edit"><i class="glyphicon glyphicon-edit"></i> Edit</a>'.
                            '<form action="'.route('produk.destroy', [$produk->id]).'" method="POST" class="pull-right" style="margin-left:10px">'.
                                method_field('DELETE').
                                csrf_field().
                                '<input type="submit" class="btn btn-xs btn-danger delete" value="Delete">'.
                            '</form>';
                })
                ->editColumn('price', function ($produk){
                    return number_format($produk->price, 2, ",", ".");
                })
                ->editColumn('price_sale', function ($produk){
                    return number_format($produk->price_sale, 2, ",", ".");
                })
                ->make(true);
    }

    public function getdataproduk(Request $request)
    {
         if ($request->ajax() == TRUE) {
            $nama_produk = $request->post('nama_produk');
            $data        = Product::where('name', '=', $nama_produk)->first();
            if ($data) {
                $data = array(
                    'success'        => TRUE, 
                    'id'             => $data->id, 
                    'name'           => $data->name, 
                    'stock_tersedia' => $data->stock, 
                    'price'          => $data->price,
                    'price_sale'     => $data->price_sale
                );
            }else{
                $data['errors'] = "Data Tidak Di Temukan";
            }
            return response()->json($data);
        }
        return abort(404);
    }
}
