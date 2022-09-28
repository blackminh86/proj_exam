<?php

namespace App\Http\Livewire\Admin;
use Livewire\Component;
use App\Models\MenuModel;
class MenuType extends Component
{
    public $type;
    public $rowId;
    public $controllerName;
    public $typeList = [
        'link' => 'Liên kết',
        'article_categories' => 'Danh mục bài viết',
        'product_categories' => 'Danh mục sản phẩm'  
    ];
    public function mount($type, $rowId, $controllerName){
        $this->rowId = $rowId ;
        $this->type = $type ;
        $this->controllerName = $controllerName ;
    }
    public function update($type){
        MenuModel::where(['id'=>$this->rowId])
                 ->update(['type'=>$type]);
    }

    public function render()
    {
        return view('livewire.admin.menu-type',[
            'type' => self::update($this->type) 
        ]);
    }
}
