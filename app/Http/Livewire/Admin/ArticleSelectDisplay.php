<?php
namespace App\Http\Livewire\Admin;
use Livewire\Component;
use App\Models\Article;
class ArticleSelectDisplay extends Component  
{
    public $type ;
    public $rowId ;
    public $items = [
        'featured' => 'Nôỉ bật',
        'normal' => 'Bình thường'
    ];
    
    public function mount($type,$rowId){
        $this ->rowId   = $rowId;
        $this ->type    = $type;
    }
    public function updatedType(){
        Article::where('id', $this->rowId)->update(['type' => $this->type]);
    }
    public function render()
    {
        return view('livewire.admin.article-select-display');
    }
}
