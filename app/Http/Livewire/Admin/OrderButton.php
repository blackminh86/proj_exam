<?php

namespace App\Http\Livewire\Admin;
use Livewire\Component;
use App\Models\Order;
class OrderButton extends Component
{
    public $type ;
    public $rowId ;
    public $circleClick = ['pending' , 'shipping' , 'delivered' , 'received payment' , 'return'] ;

    public function mount($status,$rowId){
        $this ->rowId     = $rowId;
        $this ->status    = $status;
    }
    public function changeStatus()
    {
        $key = array_search($this ->status , $this->circleClick) ;
        $max = count($this -> circleClick)-1 ;
        $key = ($key  == $max ) ? 0 : $key+1 ;
        $this->status = $this->circleClick[$key] ;
        Order::where('id', $this->rowId)->update([ 'status' => $this->status ]);
    }
 
    public function render()
    {
        return view('livewire.admin.order-button');
    }
}
