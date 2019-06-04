<?php


/* PRODUCTS HELPERS */
function getProductAmountById($id){

    return \DB::table('products')->where('id', $id)->value('amount');
}

function getProductNameById($id){

    return \DB::table('products')->where('id', $id)->value('name');
}

function getProductUrlByProductId($id){

    return \DB::table('products')->where('id', $id)->value('url');

}


function getProductImageById($id){
    $get = DB::table('products')->where('id', $id)->value('images');
    $get = json_decode($get);
    $get = $get[0];
    return $get;
}

/* STORE HELPERS */


function countProductByStore($storeid){
    return \DB::table('products')->where('store_id', $storeid)->count();
}

function getStoreNameByStoreId($id){

    return \DB::table('store')->where('id', $id)->value('name');

}


function getStoreProfileImageByStoreName($name){

    return \DB::table('store')->where('name', $name)->value('profileimg');

}


function getCartTotalCostByProductsHistoryId($id){
    $ge = DB::table('cart')->where('history_id', $id)->get();
    $cost = 0;
    foreach ($ge as $g) {
        $cost += $g->cost;
    }
    return $cost;
}

function getCartByProductHistoryId($id){
    
    return \DB::table('cart')->where('history_id', $id)->get();
}
