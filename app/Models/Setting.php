<?php

namespace App\Models;

use App\Models\AdminModel;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class Setting extends AdminModel
{
    public function __construct()
    {
        $this->table               = 'setting';
        $this->folderUpload        = 'setting';
        $this->fieldSearchAccepted = ['name', 'description'];
        $this->crudNotAccepted     = ['_token', 'thumb_current'];

    }
    public function loadItem()
    {
        $result = null;
        $result = self::select('type_setting', 'description')->get()->pluck('description','type_setting');
        return $result;
    }
    static function getAccount()
    {
        $result = self::select('setting_email_acc', 'description')->get()->toArray();
        $result = json_decode ($result , true);
        return $result;
    }

    public function saveItem($params = null, $options = null)
    {
        if ($options['task'] == 'setting_general') {
            if (!empty($params['logo'])) {
                // Xóa hình cũ
                $this->deleteThumb($params['curent_logo']);
                // Up hình mới
                $params['logo']      = $this->uploadThumb($params['logo']);
            } else {
                $params['logo'] = $params['curent_logo'];
            }
            unset($params['curent_logo']);
        }
        unset($params['_token']);
        $description = json_encode($params, true);
        $data = ['type_setting'=>$params['type_setting'] , 'description' => $description] ;
        $result = self::where(['type_setting' => $params['type_setting']])->update(['description' => $description]);
        if($result == 0) self::insert($data) ;
    }
}
