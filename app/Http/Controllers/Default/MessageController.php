<?php

namespace App\Http\Controllers\Default;
use App\Jobs\SendEmail ;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Message ;

class MessageController extends Controller
{
    public function __construct()
    {
        $this->pathViewController = 'default.pages.message.';
        $this->controllerName     = 'message';
        $this->table              = 'messages';
        $this->model              = new Message() ;
        view()->share('controllerName', $this->controllerName);
    }
    public function show(Request $request){
        return view($this->pathViewController.'index');
    }
    public function send(Request $request)
    {
        if ($request->method() == 'GET') {
            $params = $request->data;
            $params['view'] = 'email.contact' ;
            $emailJob = new SendEmail($params) ;
            dispatch($emailJob);
            /*** Insert DB */
            $this->model->saveItem($params, array('task' => 'add-item'));
            return response()->view($this->pathViewController .  'confirm',);
        }
    }
}
