<?php

namespace App\Http\Controllers;

use App\Model\Product;
use App\Model\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Laporan extends Controller
{
    public function index()
    {
        $stoks = Product::all();
        return view('laporan.index', ['stoks' => $stoks]);
    }
}
