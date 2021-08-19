<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ProductDetails extends Model
{
    public static function addCartUser($item_cart){
        $products = [];
        $totalPrice = 0;
        $totalQuanty = 0;
        $isset_item = DB::table('descriptioncart')->where([
            ['ID_User','=',$item_cart["ID_User"]],
            ['ID_Product','=',$item_cart["ID_Product"]]
        ])->first();
        if(empty($isset_item)){
            DB::table('descriptioncart')->insert($item_cart);
        }else{
            DB::table('descriptioncart')->where([
                ['ID_User','=',$item_cart["ID_User"]],
                ['ID_Product','=',$item_cart["ID_Product"]]
            ])
            ->update(['Amount'=> DB::raw('Amount+'.$item_cart['Amount'])]);
        }
        $newcart = DB::table('descriptioncart')
        ->join('product','product.ID_Product','=','descriptioncart.ID_Product')
        ->where('ID_User',$item_cart["ID_User"])->get()->toArray();
        foreach($newcart as $cart){
            $product = array(
                'Quanty'        => $cart->Amount,
                'price'         => $cart->Amount * $cart->Price_Product,
                'productInfo'   => $cart,  
            );
            $products[$cart->ID_Product] = $product;
            $totalPrice   += $product['price'];
            $totalQuanty  += $product['Quanty'];
        }
        return [
            'products'      => $products,
            'totalPrice'    => $totalPrice,
            'totalQuanty'   => $totalQuanty,
        ];
    }
}
