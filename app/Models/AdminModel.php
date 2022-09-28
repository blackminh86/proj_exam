<?php

namespace App\Models;
use App\Models\ProductCategory ;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use DB;

class AdminModel extends Model
{

    public $timestamps = true;
    protected $folderUpload     = '';
    protected $fieldSearchAccepted   = ['id','name' ];
    protected $crudNotAccepted = ['_token','thumb_current',];
    public function listItems($params = null, $options = null) {
        $result = null;
        if($options['task'] == "admin-list-items") {
            $query = $this->select('*');
               
            if ($params['filter']['status'] !== "all")  {
                $query->where('status', '=', $params['filter']['status'] );
            }

            if ($params['search']['value'] !== "")  {
                if($params['search']['field'] == "all") {
                    $query->where(function($query) use ($params){
                        foreach($this->fieldSearchAccepted as $column){
                            $query->orWhere($column, 'LIKE',  "%{$params['search']['value']}%" );
                        }
                    });
                } else if(in_array($params['search']['field'], $this->fieldSearchAccepted)) { 
                    $query->where($params['search']['field'], 'LIKE',  "%{$params['search']['value']}%" );
                } 
            }

            $result =  $query->orderBy('created_at', 'desc')
                            ->paginate($params['pagination']['totalItemsPerPage']);

        }

        if($options['task'] == 'news-list-items') {
            $query = $this->select('id', 'link', 'source')
                        ->where('status', '=', 'active' )
                        ->orderBy('id', 'desc');

            $result = $query->get()->toArray();
        }



        return $result;
    }

    public function getItem($params = null, $options = null)
    {
        $result = null;

        if ($options['task'] == 'get-item') {
            $result = self::select('*')->where('id', $params['id'])->first();
        }

        if ($options['task'] == 'get-thumb') {
            $result = self::select('id', 'thumb')->where('id', $params['id'])->first();
        }

        if ($options['task'] == 'news-get-item') {
            $result = self::select('*')
                ->where('status', '=', 'active')->first();
            if ($result) $result = $result->toArray();
        }

        return $result;
    }

    public function countItems($params = null, $options  = null)
    {
        $result = null;
        if ($options['task'] == 'admin-count-items-group-by-status') {

            $query = $this::groupBy('status')
                ->select(DB::raw('status , COUNT(id) as count'))
                ->where('name', '!=' , 'root');

            if ($params['search']['value'] !== "") {
                if ($params['search']['field'] == "all") {
                    $query->where(function ($query) use ($params) {
                        foreach ($this->fieldSearchAccepted as $column) {
                            $query->orWhere($column, 'LIKE',  "%{$params['search']['value']}%");
                        }
                    });
                } else if (in_array($params['search']['field'], $this->fieldSearchAccepted)) {
                    $query->where($params['search']['field'], 'LIKE',  "%{$params['search']['value']}%");
                }
            }
           
            $result = $query->get()->toArray();
        }
        if($options['task'] == 'default-count-items-price-slider'){
            $categories = ProductCategory::descendantsAndSelf($params['category_id']);
            $categoryIdArray = [];
            foreach ($categories as $category) {
                $categoryIdArray[] = $category->id;
            }
            if($params['distancePrice'] != 0 ){
                $value = explode(',',$params['distancePrice']);
                $min = (int)$value[0] * 1000 ;    
                $max = (int)$value[1] * 1000 ; 
                $result = self::select('id')->whereIn('product_category_id', $categoryIdArray)->whereBetween('price', [$min, $max])->get()->count();
            }         
        } 

        return $result;
    }
    public function saveItem($params = null, $options = null) { 
        if($options['task'] == 'change-status') {
            $status = ($params['currentStatus'] == "active") ? "inactive" : "active";
            self::where('id', $params['id'])->update(['status' => $status ]);
        }
        if ($options['task'] == 'change-type') {
            self::where('id', $params['id'])->update(['type' => $params['currentType']]);
        }
        if($options['task'] == 'add-item') {
            $params['created_by'] = "minhnguyen";
            if(isset($params['thumb'])){
                $params['thumb']      = $this->uploadThumb($params['thumb']);
            }
            $date = date("Y-m-d H:i:s");
            $params['created_at'] = $date ;
            $params['updated_at'] = $date ;
            $id = self::insertGetId($this->prepareParams($params));  
            return $id ;          
        }
        if($options['task'] == 'edit-item') {
            if(isset($params['thumb']) && !empty($params['thumb'])){
                $this->deleteThumb($params['thumb_current']);
                $params['thumb'] = $this->uploadThumb($params['thumb']);
            }
            $params['modified_by']   = "minhnguyen";
            self::where('id', $params['id'])->update($this->prepareParams($params));
        }
    }

    public function uploadThumb($thumbObj)
    {
        $thumbName        = Str::random(10) . '.' . $thumbObj->clientExtension();
        $thumbObj->storeAs($this->folderUpload, $thumbName, 'zvn_storage_image');
        return $thumbName;
    }

    public function deleteThumb($thumbName)
    {
        Storage::disk('zvn_storage_image')->delete($this->folderUpload . '/' . $thumbName);
    }

    public function prepareParams($params)
    {
        return (array_diff_key($params, array_flip($this->crudNotAccepted)));
    }
    public function deleteItem($params = null, $options = null)
    {
        if ($options['task'] == 'delete-item') {
            if(isset($params['thumb'])){
                $item   = $this->getItem($params, ['task' => 'get-thumb']);
                $this->deleteThumb($item['thumb']);
            }
            self::where('id', $params['id'])->delete();
        }
    }

}