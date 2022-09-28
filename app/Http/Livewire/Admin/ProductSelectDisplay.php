<?php
namespace App\Http\Livewire\Admin;
use Livewire\Component;
use App\Models\Product;
class ProductSelectDisplay extends Component  
{
    public $display ;
    public $rowId ;
    public $items = [
        'normal' => 'Bình thường',
        'best-seller' => 'Bán chạy',
        'feature' => 'Nổi bật',
        'new-product' => 'Mới về',
        'special-deal' => 'Deal',

    ];
    
    public function mount($rowId,$display){
        $this ->rowId   = $rowId;
        $this ->display    = $display;
    }
    public function updatedDisplay(){
        $result = Product::where('id', $this->rowId)->update(['display' => $this->display]);

    }
    public function render()
    {
        return view('livewire.admin.product-select-display');
    }
}
