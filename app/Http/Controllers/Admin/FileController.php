<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class FileController extends Controller
{
    /*** Set For Laravel File Manager  ***/
    public function __construct()
    {
        $this->pathViewController = 'admin.pages.file.';
        $this->controllerName     = 'file';
        view()->share('controllerName', $this->controllerName);
    }
    /*** Set For Laravel File Manager  ***/
    public function index(){
        return view($this->pathViewController .'index');
    }
   
}