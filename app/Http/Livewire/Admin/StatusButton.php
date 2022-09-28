<?php

namespace App\Http\Livewire\Admin;
use DB;
use Livewire\Component;

class StatusButton extends Component
{
    public $rowId;
    public $status;
    public $table;

    public function mount($rowId, $status,$table )
    {
        $this->rowId   = $rowId;
        $this->status  = $status;
        $this->table = $table;
    }
    public function changeStatus()
    {
        $this->status  = ($this->status == "active") ? "inactive" : "active";
        DB::table($this->table )->where('id', $this->rowId)->update(['status' => $this->status]);
    }
 
    public function render()
    {
        return view('livewire.admin.status-button');
    }
}
