<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin as MainModel;
use App\Http\Requests\ChangepassRequest as MainRequest;

class ChangepassController extends Controller
{
    
    public function __construct()
    {
        $this->model = new MainModel();
        $this->pathViewController = 'admin.pages.changepass.';
        $this->controllerName     = 'changepass';
        view()->share('controllerName', $this->controllerName);
    }
    
    public function index(Request $request){
        return view($this->pathViewController .'index' );
    }

    public function save(MainRequest $request)
    {
        if ($request->method() == 'POST') {
            $params = $request->all();
            $this->model->saveItem($params, ['task' => 'change-password']);
            return redirect()->route($this->controllerName)->with("zvn_notify", "Thay đổi mật khẩu thành công!");   
        }
    }

}
