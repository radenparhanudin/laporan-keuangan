<?php
function set_active($uri, $output = 'active')
{
    if( is_array($uri) ) {
        foreach ($uri as $u) {
            if (Route::is($u)) {
                return $output;
            }
        }
    } else {
        if (Route::is($uri)){
            return $output;
        }
    }
}

function laporan($type_transaction, $product_id)
{
    return $laporan =  DB::table('transactions')
                ->where('type_transaction', $type_transaction)
                ->where('product_id', $product_id)
                ->select('product_id', DB::raw("SUM(total_price) as total"))
                ->groupBy('product_id')
                ->first();
}