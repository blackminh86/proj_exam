<?php

namespace App\Http\Livewire\Admin;

use App\Models\Category;
use Livewire\Component;

class UpDownButton extends Component
{
    public $rowId;
    public $controllerName;
    public $up;
    public $down;
    public $node;
    public $currentPage;
    public $model;

    public function mount($rowId, $controllerName , $currentPage)
    {
        $this->currentPage = $currentPage ;
        $this->rowId   = $rowId;
        $this->controllerName = $controllerName;
        $node   = Category::find($rowId);
        $this->node = $node;
        $this->model = new Category();
        // If prev|next is empty, this node not having neighboor . If not empty, to get node neighboor 
        $this->up   = $node->getPrevSibling();
        $this->down = $node->getNextSibling();
    }
    public function upPossion()
    {
        //Deal node
        //$this->model::where('id', $this->node->id)->update(['_lft' => $this->up->_lft, '_rgt' => ($this->up->_rgt)]);;
        //Deal up
        //$this->model::where('id', $this->up->id)->update(['_lft' => $this->node->_lft, '_rgt' => ($this->node->_rgt)]);
        //$result = $this->model->updateLRL();
    
        //return redirect()->route($this->controllerName)->with("zvn_notify", 'Cập nhật phần tử thành công!');

        $this->node->up();  
    }
    public function downPossion()
    {
        //Deal _lft & _rgt of node
        $this->model::where('id', $this->node->id)->update(['_lft' => $this->down->_lft, '_rgt' => ($this->down->_rgt)]);;
        //Deal _lft & _rgt of up
        $this->model::where('id', $this->down->id)->update(['_lft' => $this->node->_lft, '_rgt' => ($this->node->_rgt)]);
        $this->model->updateLRL();
        //return redirect()->route($this->controllerName)->with("zvn_notify", 'Cập nhật phần tử thành công!');
        //$this->node->down();
    }
    public function render()
    {
        return view('livewire.admin.up-down-button', [
            'up'           => $this->up,
            'down'         => $this->down,
        ]);
    }
}
