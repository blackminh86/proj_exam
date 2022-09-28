<?php

namespace App\Http\Livewire\Admin;
use Livewire\Component;
use App\Models\Message;
class MessageButton extends Component
{
    public $type ;
    public $rowId ;
    //public $items =  ['unread' => 'Chưa đọc', 'replied' => 'Đã phản hồi'];
    
    public function mount($status,$rowId){
        $this ->rowId   = $rowId;
        $this ->status    = $status;
    }
    public function changeStatus()
    {
        $this->status  = ($this->status == "unread") ? "replied" : "unread";
        Message::where('id', $this->rowId)->update(['status' => $this->status]);
    }
 
    public function render()
    {
        return view('livewire.admin.message-button');
    }
}
