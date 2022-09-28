<?php

namespace App\Http\Controllers\Default;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product as MainModel;
use App\Models\ProductCategory ;
use DB;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->pathViewController = 'default.pages.product.';
        $this->controllerName     = 'product';
        $this->table              = 'products';
        $this->model = new MainModel();
        view()->share('controllerName', $this->controllerName);
        view()->share('table',  $this->table);
    }
    public function show(Request $request)
    {
        $this->params['id'] = $request->id;
        $itemAPI = [];
        $item = $this->model->getItem($this->params, ['task' => 'get-item']);
        $category = new ProductCategory() ;
        $breadcumb = $category->breadcumb($item->product_category_id);
       
        if ($request->session()->has('cart') == null) {
            $request->session()->put('cart', []);
        }
        if ($item->type == 'scrape') {
            $itemAPI = $this->model->callAPI($item->ecommerce_id);
        }

        return view($this->pathViewController . 'index', [
            'breadcumb'    => $breadcumb ,
            'category_id'  => $item -> product_category_id ,
            'item'         => $item,
            'itemAPI'      => $itemAPI,
        ]);
    }
    public function ajax(Request $request)
    {
        $maxPage = null;
        $params = $request->all();
        $params['limit'] = 18;
        $productModel = new Product;
        $products = $productModel->ajaxFrontend($params, ['task' => 'changePage']);
        $display = $params['display'];
        if ($params['distancePrice'] != 0) {
            $countItems = $productModel->countItems($params, ['task' => 'default-count-items-price-slider']);
            $maxPage = $countItems / $params['limit'];
            if ((int)$maxPage - $maxPage != 0) {
                $maxPage = (int)$maxPage + 1;
            }
        }
        return response()->view($this->pathViewController .  'child-index.content', compact(['products', 'display', 'maxPage']));
    }
    public function ajaxVariation(Request $request)
    {
        $params = $request->data;
        if (isset($params['attribute_value']) && isset($params['product_id'])) {
            $attribute_value     = $params['attribute_value'];
            $product_id = $params['product_id'];
            $strId      = '';
            foreach ($attribute_value  as  $value) {
                if ($value != null) {
                    $strId .= '-' . $value;
                } else {
                    die();
                }
            }
            $strId = ltrim($strId, "-");
            
            $result = DB::table('variation_products')->select('*')
                ->where('variation', $strId)
                ->where('product_id', $product_id)
                ->get()->toArray();
                //dd($strId,$product_id,$result);
                
            return response()->json($result);
        }
    }
    
}
