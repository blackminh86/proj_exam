<?php

namespace App\Http\Controllers\Default;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductCategory as MainModel;
use App\Models\Product ;

class ProductCategoryController extends Controller
{
    public function __construct()
    {
        $this->pathViewController = 'default.pages.category.';
        $this->controllerName     = 'productCategory';
        $this->table              = 'product_categories';
        $this->model = new MainModel();
        $this->params["pagination"]["totalItemsPerPage"] = 18;
        view()->share('controllerName', $this->controllerName);
        view()->share('table',  $this->table);
    }
    public function show($slug=null,$id){
        $this->params['category_id'] = $id ;
        $productModel = new Product;
        $products = $productModel -> listItems($this->params , ['task' => 'show-items-in-category']);
        //Get Color
        $value = ['MÀU SẮC', 'Màu sắc' , 'Màu' , 'COLOR' , 'Color' , 'Màu Áo'] ;
        $ids = $productModel -> getAttribue($products , $value) ; 
        $value_attributes['Colors'] = $productModel -> showAttribue($products , $ids) ;
        //Get Size
        $value = ['Size', 'size' , 'Kích cỡ' ] ;
        $ids = $productModel -> getAttribue($products , $value) ; 
        $value_attributes['Size'] = $productModel -> showAttribue($products , $ids) ;
        //Breadcumb
        $breadcumb = $this->model->breadcumb($id) ;
        return view($this->pathViewController . 'index' ,[
            'breadcumb'        => $breadcumb, 
            'category_id'      => $id ,
            'products'         => $products ,
            'value_attributes' => $value_attributes
        ]);
    }
    public function ajax(Request $request){
        $maxPage = null ;
        $params = $request->all();
        $params['limit'] = 18 ;
        $productModel = new Product;
        $products = $productModel -> ajaxFrontend($params , ['task' => 'changePage']);
        $display = $params['display'];
        if($params['distancePrice'] != 0){
            $countItems = $productModel -> countItems($params, ['task' => 'default-count-items-price-slider']) ;
            $maxPage = $countItems / $params['limit'] ; 
            if((int)$maxPage - $maxPage != 0 ){
                $maxPage = (int)$maxPage + 1 ;
            }
        }
        return response()->view($this->pathViewController .  'child-index.content' , compact(['products','display','maxPage']));                      
    }
   
}
