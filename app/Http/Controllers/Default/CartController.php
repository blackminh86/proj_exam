<?php

namespace App\Http\Controllers\Default;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CartRequest as MainRequest;

class CartController extends Controller
{
    public function __construct()
    {
        $this->pathViewController = 'default.pages.cart.';
        $this->controllerName     = 'cart';
        $this->table              = 'carts';
        view()->share('controllerName', $this->controllerName);
        view()->share('table',  $this->table);
    }
    public function store(Request $request)
    {
        $data = $request->data;
        $cartArr = $request->session()->get('cart'); 
        $keyData = array_keys($data)[0];
        if ($cartArr != null && array_key_exists($keyData, $cartArr)) {  
            $cartArr[$keyData]['quantity'] = $data[$keyData]['quantity'] + $cartArr[$keyData]['quantity'];
        }else{
            $cartArr[$keyData] =  $data[$keyData] ;
        } 
        $request->session()->forget('cart');
        $request->session()->put('cart', $cartArr);
        $number = count($request->session()->get('cart'));
        return response()->json(['itemsCart' => $number , 'cart' => $cartArr]);
    }
    public function updateCart(Request $request)
    {
        $cartArr = [] ;
        $request->session()->forget('cart');
        $data = $request->data;
        foreach($data as $carts){
            foreach ($carts as $key => $cart){
                $cartArr[$key] = $cart ;
            }
        } 
        $request->session()->put('cart', $cartArr);
        return response()->json(['status'=>'success']);
    }
    public function show(Request $request)
    {
        return view($this->pathViewController . 'index' ,[]);
    }
    public function formInfo(MainRequest $request){
        return redirect()->route('order.checkout')->with(['status' => 'pending']) ;
    }
}
