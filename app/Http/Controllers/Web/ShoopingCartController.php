<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Cart;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ShoopingCartController extends Controller
{
    public function index(){
        return view('Web/ShoopingCart');
    }
    public function UpdateCart(Request $request,$id,$quanty){
        $oldCart = Session('Cart') ? Session('Cart') : null;
        $newCart = new Cart($oldCart);
        $newCart->UpdateItemCart($id,$quanty);
        $request->Session()->put('Cart',$newCart);
        return json_encode($newCart);exit;
    }
    public function DeleteItemShoopingCart(Request $request,$id){
        $oldCart = Session('Cart') ? Session('Cart') : null;
        $newCart = new Cart($oldCart);
        $newCart->DeleteItemCart($id);
        if($newCart->products && Count($newCart->products) > 0){
            $request->Session()->put('Cart',$newCart);
        }else{
            $request->Session()->forget('Cart');
        }
        return json_encode($newCart);exit;
    }
}
