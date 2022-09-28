<?php

namespace App\Http\Livewire\Admin;
use Livewire\Component;
use DB;

class IsHomeButton extends Component
{
    public $rowId ;
    public $is_home ;
    public $table ; 

    public function mount($rowId , $is_home ,$table ){
        $this ->rowId        = $rowId ;
        $this ->is_home      = $is_home ;
        $this ->table        = $table ;
        
    }
    public function changeIshome(){
        $this->is_home  = $this->is_home  == 'yes'  ? 'no' : 'yes' ;
        DB::table($this->table)->where('id' , $this->rowId)->update(['is_home' => $this->is_home]);
    }
    public function render()
    {
        return view('livewire.admin.is-home-button');
    }
 
}
