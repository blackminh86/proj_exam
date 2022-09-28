<?php

namespace App\Http\Controllers\Admin;
use App\Models\AttributeProduct as MainModel;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AttributeProductController extends AdminController
{
    public function __construct()
    {
        $this->pathViewController = 'admin.pages.attribute_product.';
        $this->controllerName     = 'attributeProduct';
        $this->table              = 'attribute_products';
        $this->model = new MainModel();
        $this->params["pagination"]["totalItemsPerPage"] = 100;
        view()->share('controllerName', $this->controllerName);
        view()->share('table',  $this->table);
    }
    public function index(Request $request)
    {
        $this->params['filter']['status'] = $request->input('filter_status', 'all');
        $this->params['search']['field']  = $request->input('search_field', ''); // all id description
        $this->params['search']['value']  = $request->input('search_value', '');
        //Error: Call to a member function listItems() on null
        $items              = $this->model->listItems($this->params, ['task'  => 'admin-list-items']);
       // $itemsStatusCount   = $this->model->countItems($this->params, ['task' => 'admin-count-items-group-by-status']); // [ ['status', 'count']]
        return view($this->pathViewController .  'index', [
            'params'        => $this->params,
            'items'         => $items,
        ]);
    }
    public function save(Request $request)
    {
        if ($request->method() == 'POST') {
            $params = $request->all();

            $task   = "add-item";
            $notify = "Thêm phần tử thành công!";

            if ($params['id'] !== null) {
                $task   = "edit-item";
                $notify = "Cập nhật phần tử thành công!";
            }
            $this->model->saveItem($params, ['task' => $task]);
            return redirect()->route($this->controllerName)->with("zvn_notify", $notify);
        }
    }
}
