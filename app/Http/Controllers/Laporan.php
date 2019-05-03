<?php

namespace App\Http\Controllers;

use App\Model\Product;
use App\Model\LaporanKas;
use App\Model\LaporanJasa;
use App\Model\LaporanKlise;
use App\Model\LaporanPemesanan;
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

    public function kas()
    {
        $kas = LaporanKas::all();
        $pdf = PDF::loadView('laporan.cetak_kas', ['kas' => $kas]);
        return $pdf->stream();
    }

    public function klise()
    {
        $klise = LaporanKlise::all();
        $pdf = PDF::loadView('laporan.cetak_klise', ['klise' => $klise]);
        return $pdf->stream();
    }
    public function jasa()
    {
        $jasa = LaporanJasa::all();
        $pdf = PDF::loadView('laporan.cetak_jasa', ['jasa' => $jasa]);
        return $pdf->stream();
    }

}
