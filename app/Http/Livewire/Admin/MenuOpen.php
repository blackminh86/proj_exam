<?php

namespace App\Http\Livewire\Admin;
use Livewire\Component;
use App\Models\MenuModel;
class MenuOpen extends Component
{
    public $typeOpen;
    public $rowId;
    public $controllerName;
    public $typeOpenList = [
        '_self' => 'Liên kết nội bộ',
        '_blank' => 'Liên kết ngoài',
    ];
    public function mount($typeOpen, $rowId, $controllerName){
        $this->rowId = $rowId ;
        $this->typeOpen = $typeOpen ;
        $this->controllerName = $controllerName ;
    }
    public function update($typeOpen){
        MenuModel::where(['id'=>$this->rowId])
                ->update(['type_open'=>$typeOpen]);
    }

    public function render()
    {
        return view('livewire.admin.menu-open',[
            'typeOpen' => self::update($this->typeOpen) 
        ]);
    }
}
