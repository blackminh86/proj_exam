<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    protected $model;
    protected $params = [];
    protected $pathViewController = '';
    protected $controllerName     = '';
    protected $main_request = '';

    public function index(Request $request)
    {
        $this->params['filter']['status'] = $request->input('filter_status', 'all');
        $this->params['search']['field']  = $request->input('search_field', ''); // all id description
        $this->params['search']['value']  = $request->input('search_value', '');
        //Error: Call to a member function listItems() on null
        $items              = $this->model->listItems($this->params, ['task'  => 'admin-list-items']);
        $itemsStatusCount   = $this->model->countItems($this->params, ['task' => 'admin-count-items-group-by-status']); // [ ['status', 'count']]
        return view($this->pathViewController .  'index', [
            'params'        => $this->params,
            'items'         => $items,
            'itemsStatusCount' =>  $itemsStatusCount
        ]);
    }

    public function form(Request $request)
    {
        $item = null;
        if ($request->id !== null) {
            $params["id"] = $request->id;
            $item = $this->model->getItem($params, ['task' => 'get-item']);
        }
        return view($this->pathViewController .  'form', [
            'item'        => $item ,
        ]);
    }

    public function status(Request $request)
    {
        $params["currentStatus"]  = $request->status;
        $params["id"]             = $request->id;
        $this->model->saveItem($params, ['task' => 'change-status']);
        $status = $request->status == 'active' ? 'inactive' : 'active';
        $link = route($this->controllerName . '/status', ['status' => $status, 'id' => $request->id]);
        return response()->json([
            'statusObj' => config('zvn.template.status')[$status],
            'link' => $link,
        ]);
    }
    public function isHome(Request $request)
    {
        $params["currentIsHome"]  = $request->is_home;
        $params["id"]             = $request->id;
        $this->model->saveItem($params, ['task' => 'change-is-home']);
        $is_home = $request->is_home == 'yes' ? 'no' : 'yes';
        $link = route($this->controllerName . '/isHome', ['is_home' => $is_home, 'id' => $request->id]);
        return response()->json([
            'is_homeObj' => config('zvn.template.is_home')[$is_home],
            'link' => $link,
        ]);
    }
    public function display(Request $request)
    {
        $params["currentDisplay"]  = $request->display;
        $params["id"]             = $request->id;
        $this->model->saveItem($params, ['task' => 'change-display']);
        $link = route($this->controllerName . '/display', ['display' => 'value_new', 'id' => $request->id]);
        return response()->json([
            'link' => $link,
        ]);
    }
    public function delete(Request $request)
    {
        $params["id"]             = $request->id;
        $this->model->deleteItem($params, ['task' => 'delete-item']);
        return redirect()->route($this->controllerName)->with('zvn_notify', 'Xóa phần tử thành công!');
    }
    public function updateMove(Request $request)
    {   
        $root = $this->model::find(1);
        if($this->model::rebuildSubtree($root,$request->data)){
            return response()->json(['status' => 'success']);    
        }
        
    }
    

}
