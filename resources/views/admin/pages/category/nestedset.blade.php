@php
use App\Helpers\Template as Template;
$listBtnAction = Template::showButtonAction($controllerName, $item->id);
@endphp
<li class="dd-item dd3-item" data-id="{{ $item->id }}" style="line-height: 33px">
    <div class="dd-handle dd3-handle" style="height:45px ; width:35px"> Drag </div>
    <div class="dd3-content row">
        <span class="col-md-2" style="text-align:center">{{ $item->name}}</span>
        <span class="col-md-2">@livewire('admin.status-button', ['rowId' => $item->id , 'status' => $item->status , 'table' => $table] )</span>
        <span class="col-md-2">@livewire('admin.is-home-button', ['rowId' => $item->id, 'is_home' => $item->is_home , 'table' => $table] )</span>
        <span class="col-md-2">@livewire('admin.category-select-display', ['rowId' => $item->id , 'display' => $item->display , 'table' => $table])</span>
        <span class="col-md-2">{!! $listBtnAction !!}</span>
    </div>
    @if ($item->children->count() > 0)
    <ol class="dd-list">
        @foreach ($item->children as $key => $itemChildren)
        @include('admin.pages.category.nestedset',['item' => $itemChildren])
        @endforeach    
    </ol>   
        @endif
</li>