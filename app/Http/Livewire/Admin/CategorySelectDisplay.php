<?php

namespace App\Http\Livewire\Admin;

use DB;
use Livewire\Component;

class CategorySelectDisplay extends Component
{
    public $display;
    public $rowId;
    public $table;
    public $values = [
        'list' => 'Danh sách',
        'grid' => 'Lưới'
    ];

    public function mount($display, $rowId ,$table)
    {
        $this->display = $display;
        $this->rowId = $rowId;
        $this->table = $table;
        
    }

    public function updatedDisplay($display)
    {
        $this->display = $display;
        DB::table($this->table)->where('id', $this->rowId)->update(['display' => $display]);
    }

    public function render()
    {
        return view('livewire.admin.category-select-display');
    }
}
