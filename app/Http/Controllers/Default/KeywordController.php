<?php

namespace App\Http\Controllers\Default;

use App\Models\Keyword as MainModel;
use App\Models\Product;
use App\Models\ProductCategory as Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class KeywordController extends Controller
{
    public function __construct()
    {
        $this->pathViewController = 'default.pages.search.';
        $this->controllerName     = 'keyword';
        $this->table              = 'keywords';
        $this->model = new MainModel();
        $this->categoryModel = new Category;
        $this->params["pagination"]["totalItemsPerPage"] = 18;
        view()->share('controllerName', $this->controllerName);
        view()->share('table',  $this->table);
    }
    public function show(Request $request)
    {
        $category_id  = $request->category_id;
        $category_id  = ($category_id == null) ? 1 : $category_id ;
        $keyword      = $request->keyword;
        $keyword      = ($keyword == null) ? '' : $keyword ;
            $productModel = new Product();  
            $params = ['product_category_id' => $category_id, 'keyword' => $keyword];
            $params["pagination"]["totalItemsPerPage"] = $this->params["pagination"]["totalItemsPerPage"];
            $products = $productModel->listItems($params, ['task' => 'show-items-in-search']);
            $breadcumb = $this->categoryModel->breadcumb($category_id);
        //Save Keyword
        if($keyword != null){
            $params['ip'] = request()->ip();   
            $this->model->saveItem($params , ['task' => 'add-item']) ;
        }
        return response()->view($this->pathViewController . 'index', [
            'breadcumb'        => $breadcumb,
            'category_id'      => $category_id,
            'products'         => $products,
            'value_attributes' => null,
            'keyword'          => $keyword,
        ]);
    }
}
