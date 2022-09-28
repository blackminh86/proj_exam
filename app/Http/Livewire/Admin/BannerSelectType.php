<?php
namespace App\Http\Livewire\Admin;
use App\Models\Banner;
use Livewire\Component;

class BannerSelectType extends Component
{
    public $type ;
    public $rowId ;
    public $items =  ['default' => 'Select Type', 'slider' => 'Slider' , 'left_banner' => 'Left Banner' , 'right_banner' => 'Right Banner' , 'wide_banner' => 'Wide Banner'];
    
    public function mount($type,$rowId){
        $this ->rowId   = $rowId;
        $this ->type    = $type;
    }
    public function updatedType(){
        Banner::where('id', $this->rowId)->update(['type' => $this->type]);
    }
    public function render()
    {
        return view('livewire.admin.banner-select-type');
    }
}
