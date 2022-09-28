<?php

namespace App\Http\Controllers\Default;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\ProductOrder;
use App\Models\Customer;
use App\Jobs\SendEmail ;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->pathViewController = 'default.pages.order.';
        $this->controllerName     = 'order';
        $this->table              = 'orders';
        $this->model = new Order() ;
        $this->product_order_model = new ProductOrder() ;
        $this->customer_model = new Customer() ;
        view()->share('controllerName', $this->controllerName);
        view()->share('table',  $this->table);
    }
    public function store(Request $request){ 
        $cart = $request->session()->get('cart');
        if(!empty($cart)){
            //Save Customer
            $customer    = $request->session()->get('shipping-info');
            $customer_id = $this->customer_model->saveItem($customer , ['task' => 'add-item']) ; 
            //Save Order
            $order_id    = $this->model->saveOrder($cart , $customer_id) ;
            //Save Product Order
            $this->product_order_model->saveProductOrder($cart, $order_id); 

            $params = ['email'=> $customer['email'] , 'name'=> $customer['fullname'] , 'view'=> 'email.confirm_order' ] ;
            $emailJob = new SendEmail($params) ;
            dispatch($emailJob); 
        }  
        $request->session()->forget('cart');  
        return view($this->pathViewController . 'index' , ['status'=>'finish']) ;
    }
    public function checkout(){
        return view($this->pathViewController . 'index') ;
    }
}
