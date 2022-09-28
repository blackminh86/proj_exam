<?php

namespace App\Http\Livewire\Admin;
use App\Models\MenuModel;
use Livewire\Component;

class Ordering extends Component
{
    public $ordering;
    public $rowId;
    public $controllerName;

    public function mount($ordering, $rowId, $controllerName)
    {
        $this->rowId = $rowId ;
        $this->type = $ordering;
        $this->controllerName = $controllerName ; // Truyen table
    }
    public function update($ordering){
        $ordering = (is_numeric($ordering)) ? $ordering : NULL ;
        MenuModel::where(['id'=>$this->rowId])
                ->update(['ordering'=>$ordering]);
    }
    public function render()
    {
        return view('livewire.admin.ordering' , [
            'ordering' => self::update($this->ordering) 
        ]);
    }
}
