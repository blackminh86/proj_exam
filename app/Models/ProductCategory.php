<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class ProductCategory extends ArticleCategory
{
    public function __construct() {
        $this->connection   = 'mysql';
        $this->folderUpload        = 'product_category';
        $this->fieldSearchAccepted = ['name'];
        $this->crudNotAccepted     = ['_token'];
        
    }
    public function listItems($params = null, $options = null)
    {
        /** Need use ->paginate to do ajax */
        $items = null ;
        if ($options['task'] == "admin-list-items") {
            $items = self::withDepth()->where('id','>',1) ;

            if ($params['filter']['status'] !== "all") {
                $items = $items->where('status', '=', $params['filter']['status']);
            }
            if ($params['search']['value'] !== "") {
                if ($params['search']['field'] == "all") {
                    $items = $items->where(function ($items) use ($params) {
                        foreach ($this->fieldSearchAccepted as $column) {
                            $items->orWhere($column, 'LIKE',  "%{$params['search']['value']}%");
                        }
                    });
                } else if (in_array($params['search']['field'], $this->fieldSearchAccepted)) {
                    $items = $items->where($params['search']['field'], 'LIKE',  "%{$params['search']['value']}%");
                }
            }
                $items = $items ->orderBy('_lft', 'asc')
                                ->paginate($params['pagination']['totalItemsPerPage']);       
        }
        return $items;
    }

    public function autoCategory($id , &$newArray){
		$url="https://tiki.vn/api/personalish/v1/blocks/listings?limit=48&include=advertisement&aggregations=2&trackity_id=8ab0fb29-4c1a-3e94-8b7f-62922d5fcc3a&category=$id&page=1";
        $str = file_get_contents($url);
        $json = json_decode($str,true);
        $source = (isset($json['filters'][0]['values'])) ? $json['filters'][0]['values'] : null;
        
            if(isset($source[0]['url_key'])){
                foreach ($source as $key => $value){
                    $val['id'] = $value['query_value'];  
                    $val['name'] = $value['display_value'];
                    $val['status']= 'active';
                    $val['is_home']= 'yes';
                    $val['display']= 'list';
                    $val['parent_id']= $id;        
                    $newId = $val['id'];
                    unset($source[$key]);
                    $newArray[]=$val;
                    $this->autoCategory($newId , $newArray);
                } 
            }
                return $newArray ;
        }
    public function breadcumb($id){
        $breadcumbs = self::whereAncestorOrSelf($id)->get()->pluck('name','id');
        return $breadcumbs;

    }
  
}
