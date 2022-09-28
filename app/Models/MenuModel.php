<?php

namespace App\Models;

class MenuModel extends ArticleCategory
{
    public function __construct() {
        $this->table               = 'menu';
        $this->fieldSearchAccepted = ['id', 'name', 'link']; 
        $this->crudNotAccepted     = ['_token'];
    }

}

