<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting as MainModel;
use App\Http\Requests\SettingRequest as MainRequest;

class SettingController extends Controller
{
    
    public function __construct()
    {
        $this->model = new MainModel();
        $this->pathViewController = 'admin.pages.setting.';
        $this->controllerName     = 'setting';
        view()->share('controllerName', $this->controllerName);
    }
    
    public function index(){
        $items              = $this->model->loadItem();
        return view($this->pathViewController .'index' ,[
        'items'         => $items,
        ]);
    }

    public function save(Request $request)
    {
        if ($request->method() == 'POST') {
            $params = $request->all();
            $notify = "Cập nhật thành công!";
            $this->model->saveItem($params, ['task' => $params['type_setting'] ]);
            return redirect()->route($this->controllerName)->with("zvn_notify", $notify);
        }
    }

}
