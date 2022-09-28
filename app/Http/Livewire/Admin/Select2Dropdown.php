<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;

class Select2Dropdown extends Component
{
    public $list = '';
    public $categoryId = '';
    public $elementName = '';
    public $elementId = '';
    public $type = '';
    public function mount($list , $categoryId, $elementName , $elementId , $type){
        $this->list        = $list ;
        $this->categoryId  = $categoryId;
        $this->elementName = $elementName;
        $this->elementId   = $elementId;
        $this->type        = $type;
    }
    public function render()
    {
        return view('livewire.admin.select2-dropdown');
    }
}
