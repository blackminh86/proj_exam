<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ArticleCategory as MainModel;
use App\Http\Requests\ArticleCategoryRequest as MainRequest;

class ArticleCategoryController extends AdminController
{
    public function __construct()
    {
        $this->pathViewController = 'admin.pages.category.';
        $this->controllerName     = 'articleCategory';
        $this->table              = 'article_categories';
        $this->model = new MainModel();
        $this->params["pagination"]["totalItemsPerPage"] = 20;
        view()->share('controllerName', $this->controllerName);
        view()->share('table',  $this->table);
    }

    public function form(Request $request)
    {
        $item = null;
        if ($request->id !== null) {
            $params["id"] = $request->id;
            $item = $this->model->getItem($params, ['task' => 'get-item']);
        }
        return view($this->pathViewController .  'form', [
            'item'         => $item ,
        ]);
    }

    public function save(MainRequest $request)
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
            MainModel::fixTree();
            return redirect()->route($this->controllerName)->with("zvn_notify", $notify);
        }
    }

    public function isHome(Request $request)
    {
        $params["currentIsHome"]  = $request->is_home;
        $params["id"]             = $request->id;
        $this->model->saveItem($params, ['task' => 'change-is-home']);
        $isHomeValue = $request->is_home == 'yes' ? 'no' : 'yes';
        $link = route($this->controllerName . '/isHome', ['is_home' => $isHomeValue, 'id' => $request->id]);
        return response()->json([
            'isHomeObj' => config('zvn.template.is_home')[$isHomeValue],
            'link' => $link,
        ]);
    }

    public function display(Request $request)
    {
        $params["currentDisplay"]   = $request->display;
        $params["id"]               = $request->id;
        $this->model->saveItem($params, ['task' => 'change-display']);
        return response()->json([
            'status' => 'success'
        ]);
    }


}
