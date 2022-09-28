<?php

namespace App\Http\Livewire\Admin;
use Livewire\Component;
use DB;
class SelectCategory extends Component
{
    public $categoryId;
    public $table;
    public $category;
    public $rowId;

    public function mount($category,$categoryId,$rowId,$table){
      
        $this->category = $category;
        $this->rowId = $rowId ;
        $this->categoryId = $categoryId ;
        $this->table = $table ;

    }
    public function updatedCategoryId(){
        $col =  substr_replace($this->table ,"", -1) .'_category_id' ;
       DB::table($this->table)->where(['id'=>$this->rowId])
                             ->update([$col =>$this->categoryId]);  
    }
    public function render()
    {
        return view('livewire.admin.select-category');
    }
}
