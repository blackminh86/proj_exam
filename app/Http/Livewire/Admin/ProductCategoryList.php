<?php

namespace App\Http\Livewire\Admin;
use DB;
use Livewire\Component;

class ProductCategoryList extends Component
{
    public $items ;
    public $curentPage ;
    public $table;
    public $display;
    public $values = [
        'list' => 'Danh sách',
        'grid' => 'Lưới'
    ];
    public function mount($items , $curentPage , $table){
        $this->items = $items['data'];
    }
    public function changeStatus($key , $id , $status)
    {
        $status = ($status == "active") ? "inactive" : "active";
        DB::table($this->table )->where('id', $id)->update(['status' => $status]);
        $this->items[$key]['status'] = $status;
    }
    public function changeIshome($id , $ishome){
        $ishome  = $ishome  == 'yes'  ? 'no' : 'yes' ;
        DB::table($this->table)->where('id' , $id)->update(['is_home' => $ishome]);
    }
    public function updatedDisplay($value)
    {
        $this->display = $value;
        DB::table($this->table)->where('id', $this->rowId)->update(['display' => $value]);
    }
    public function render()
    {
        dd($this->items );
        return view('livewire.admin.product-category-list',[
            'items' => $this->items 
        ]);
    }
}
