<?php

namespace App\Http\Controllers\Default;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->pathViewController = 'default.pages.home.';
        $this->controllerName     = 'home';
        $this->banner  = new  Banner();
        $this->product = new Product();
        view()->share('controllerName', $this->controllerName);
    }
    public function index(){
        $banners      = $this->banner->showBanner();
        $item_home       = $this->product->listItems( [] , ['task' => 'show-items-in-home']);

        return view($this->pathViewController . 'index' ,[
            'banners'      => $banners ,
            'item_home'   => $item_home ,
        ]);
    }
}
