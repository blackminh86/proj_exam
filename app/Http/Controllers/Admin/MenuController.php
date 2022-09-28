<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MenuModel as MainModel;
use App\Http\Requests\MenuRequest as MainRequest;

class MenuController extends AdminController
{
    public function __construct()
    {
        $this->pathViewController = 'admin.pages.menu.';  // slider
        $this->controllerName     = 'menu';
        $this->table     = 'menu';
        $this->model = new MainModel();
        //$this->params["pagination"]["totalItemsPerPage"] = 5;
        view()->share('controllerName', $this->controllerName);
        view()->share('table', $this->table);
    }
    public function type(Request $request)
    {
        $path = $request->path();
        if(strpos($path, 'change-type-menu')) {
            $params["col"] = 'type';
            $type = 'type_menu';
        }
        if(strpos($path, 'change-type-open')){
            $params["col"] = 'type_open';
            $type = 'type_open';
        }

        $params["currentType"]    = $request->$type;
        $params["id"]             = $request->id;
 
        $this->model->saveItem($params, ['task' => 'change-type']);
        return response()->json([
            'status' => 'success'
        ]);
    }
    public function save(MainRequest $request)
    {
        if ($request->method() == 'POST') {
            $params = $request->all();
            $params['parent_id'] = 1 ; 

            $task   = "add-item";
            $notify = "Thêm phần tử thành công!";

            if ($params['id'] !== null) {
                $task   = "edit-item";
                $notify = "Cập nhật phần tử thành công!";
            }
            $this->model->saveItem($params, ['task' => $task]);
            MainModel::fixTree();
            return redirect()->route($this->controllerName)->with("zvn_notify", $notify);
        }
    }
}
