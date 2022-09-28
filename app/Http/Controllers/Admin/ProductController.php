<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Product as MainModel;
use App\Http\Requests\ProductRequest as MainRequest;


class ProductController extends AdminController
{
    public function __construct()
    {
        $this->pathViewController = 'admin.pages.product.';  // slider
        $this->controllerName     = 'product';
        $this->table     = 'products';
        $this->model = new MainModel();
        $this->params["pagination"]["totalItemsPerPage"] = 20;
        view()->share('controllerName', $this->controllerName);
        view()->share('table', $this->table);
    }
    public function draft(Request $request)
    {
        view()->share('action', 'draft');
        $this->params['filter']['status'] = $request->input('filter_status', 'all');
        $this->params['search']['field']  = $request->input('search_field', ''); // all id description
        $this->params['search']['value']  = $request->input('search_value', '');
        $items              = $this->model->listItems($this->params, ['task'  => 'admin-list-draft']);
        return view($this->pathViewController .  'index', [
            'params'        => $this->params,
            'items'         => $items,
        ]);
    }
    public function form(Request $request)
    {
        $item = null;
        $tempId = '';
        if ($request->id !== null) {
            $params["id"] = $request->id;
            $item = $this->model->getItem($params, ['task' => 'get-item']);
        } else {
            $tempId = $this->model->saveItem([], ['task' => "add-draft"]);
        }
        return view($this->pathViewController .  'form', [
            'item'        => $item,
            'tempId'      => $tempId
        ]);
    }
    public function dataScraperForm(Request $request)
    {
        return view($this->pathViewController . 'data_scraper_form');
    }
    public function dataScraper(Request $request)
    {
        if ($request->method() == 'POST') {
            $notify = '';
            $params = $request->all();
            $beginId = MainModel::max('id');
            $array = $this->model->scrapDataTk($params);
            $lastId  = MainModel::max('id');
            //Get attribute & variation 
            $this->model->getVariationTk($beginId, $lastId);
            $notify = "Having " . $array['count'] . " item(s) inserted into database";
            return view($this->pathViewController . 'data_scraper_form', [
                'notify'        => $notify,
                'category_id'   => $array['category_id']
            ]);
        }
    }
    public function saveDraft(Request $request)
    {
        if ($request->method() == 'POST') {
            $params = $request->all();
            if ($params['id'] !== null) {
                $task   = "edit-item";
                $notify = "Cập nhật phần tử thành công!";
            }
            $params['draft'] = "yes";
            $this->model->saveItem($params, ['task' => $task]);
            return redirect()->route($this->controllerName . '/draft')->with("zvn_notify", $notify);
        }
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
            $params['draft'] = null;
            $this->model->saveItem($params, ['task' => $task]);

            return redirect()->route($this->controllerName)->with("zvn_notify", $notify);
        }
    }
    public function ajaxAttribute(Request $request)
    {
        return response()->view($this->pathViewController .  'ajax_attribute',);
    }
    public function deleteVariableElement(Request $request)
    {
        $params = $request->all();
        if (isset($params['id']) && !empty($params['id'])) {
            $this->model->deleteVariableElement($params['id']);
            return response()->json(['status' => 'success']);
        }
    }
    public function ajaxVariation(Request $request)
    {
        $params = $request->data;
        $this->model->deleteVariation($params['product_id']);
        $attributeIdArr      = $this->model->insertAttribute($params);
        $attributeValueIdArr = $this->model->insertAttributeProduct($params, $attributeIdArr);
        $this->model->insertVariation($params['product_id'], $attributeValueIdArr);
        $variation = $this->model->loadVariation($params['product_id']);
        return response()->view($this->pathViewController .  'variation', compact('variation'));
    }
}
