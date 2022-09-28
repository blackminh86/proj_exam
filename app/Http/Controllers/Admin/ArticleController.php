<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Models\Article as MainModel;
use App\Models\Category;
use App\Http\Requests\ArticlesRequest as MainRequest;

class ArticleController extends AdminController
{

    public function __construct()
    {
        $this->pathViewController = 'admin.pages.article.';  // slider
        $this->controllerName     = 'article';
        $this->table     = 'articles';
        $this->model = new MainModel();
        $this->params["pagination"]["totalItemsPerPage"] = 25;
        view()->share('controllerName', $this->controllerName);
        view()->share('table', $this->table);
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
            return redirect()->route($this->controllerName)->with("zvn_notify", $notify);
        }
    }

}
