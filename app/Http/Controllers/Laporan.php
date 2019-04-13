<?php

namespace App\Http\Controllers;

use App\Model\Product;
use App\Model\Transaction;
// use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade as PDF;
class Laporan extends Controller
{
    public function index()
    {
        $stoks = Product::all();
        return view('laporan.index', ['stoks' => $stoks]);
    }

    public function cetak()
    {
        $stoks = Product::all();
        // return view('laporan.cetak', ['stoks' => $stoks]);
        // die();
        $pdf = PDF::loadView('laporan.cetak', ['stoks' => $stoks]);
        return $pdf->stream();
    }

}
