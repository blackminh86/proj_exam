<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Message as MainModel;
use Illuminate\Http\Request;

class MessageController extends AdminController
{
    public function __construct()
    {
        $this->pathViewController = 'admin.pages.message.';  
        $this->controllerName     = 'message';
        $this->table     = 'messages';
        $this->model = new MainModel();
        $this->params["pagination"]["totalItemsPerPage"] = 20;
        view()->share('controllerName', $this->controllerName);
        view()->share('table', $this->table);
    }



}
