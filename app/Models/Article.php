<?php

namespace App\Models;

use App\Models\AdminModel;

class Article extends AdminModel
{
    public function __construct(){
        $this->folderUpload        = 'article';
        $this->fieldSearchAccepted = ['name', 'content'];
        $this->crudNotAccepted     = ['_token', 'thumb_current'];
    }

    public function listItems($params = null, $options = null)
    { 
        $result = null;
        if ($options['task'] == "admin-list-items") {
            $query = self::with('articleCategory')->select('*')   ;  

            if ($params['filter']['status'] !== "all") {
                $query->where('status', '=', $params['filter']['status']);
            }
            $result =  $query->orderBy('id', 'desc')
                ->paginate($params['pagination']['totalItemsPerPage']);
        }

        return $result;
    }
    public function getItem($params = null, $options = null)
    {
        $result = null;
        if ($options['task'] == 'get-item') {
            $result = self::with('articleCategory')->select('*')->where('id', $params['id'])->first();
        }
        return $result;
    }
   
    public function articleCategory(){
        return $this->belongsTo(ArticleCategory::class);
    }

}
