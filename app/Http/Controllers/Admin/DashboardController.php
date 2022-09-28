<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class DashboardController extends Controller
{
    private $pathViewController = 'admin.pages.dashboard.';  // slider
    private $controllerName     = 'dashboard';

    public function __construct()
    {
        view()->share('controllerName', $this->controllerName);
    }

    public function index()
    {
        $params['count_article'] = DB::table('articles')->count() ;
        $params['count_category'] = DB::table('article_categories')->count() ;
        $params['count_menu'] = DB::table('menu')->count() ;
        $params['count_slider'] = DB::table('sliders')->count() ;

        return view($this->pathViewController .  'index', [
            'params' => $params ,
        ]);
    }
}
