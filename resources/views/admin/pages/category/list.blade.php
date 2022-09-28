@php
use Illuminate\Support\Facades\Route;
@endphp
<div class="x_content">
<input type="hidden" name="curentUrl" value="{!! route($controllerName) !!}">  
    <div class="cf nestable-lists">
        <div class="dd" id="nestable3">
            <ol class="dd-list">
                @foreach($items as $item)
                    @if($item->depth == 1)
                        @include('admin.pages.category.nestedset',['item' => $item])
                    @endif
                @php        
                @endphp
                @endforeach
            </ol>
        </div>
    </div>
</div>

