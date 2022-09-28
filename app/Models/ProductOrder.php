<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductOrder extends AdminModel
{
    protected $fieldSearchAccepted   = ['id', 'order_id', 'product_id', 'variation_product_id', 'amount' , 'order_price'];
    protected $fillable   = ['id', 'order_id', 'product_id', 'variation_product_id', 'amount' , 'order_price'];
    use HasFactory;
    public function saveProductOrder($cart, $order_id)
    {
        foreach ($cart as $value) {
            $product['order_id']             = $order_id;
            $product['product_id']           = $value['product_id'];
            $product['variation_product_id'] = $value['variable_id'];
            $product['amount']               = $value['quantity'];
            $product['order_price']          = $value['price'];
            self::create($product);
        }

    }
}
