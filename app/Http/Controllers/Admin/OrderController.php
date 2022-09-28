<?php

namespace App\Http\Controllers\Admin;
use App\Models\Order as MainModel;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderController extends AdminController
{
    public function __construct()
    {
        $this->pathViewController = 'admin.pages.order.';  
        $this->controllerName     = 'order';
        $this->table     = 'orders';
        $this->model = new MainModel();
        $this->params["pagination"]["totalItemsPerPage"] = 20;
        view()->share('controllerName', $this->controllerName);
        view()->share('table', $this->table);
    }
    
}
