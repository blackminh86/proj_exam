
<div>
    <div wire:ignore>
        <select class="form-control  select2-dropdown" name="{{ $elementName }}" id="{{ $elementId }}">
            <option value="0">Select Option</option>
                @foreach($list as $id => $name)
                {{$name}}
                    @if($type == 'category')
                    @php 
                    $value = explode('_',$name)
                    @endphp
                        <option value="{{ $value[1] }}"  @if($value[1] == $categoryId) {{ "selected ='selected'" }} @endif > {{ $value[0] }}  </option>
                    @else
                    <option value="{{ $id }}"  @if($id == $categoryId) {{ "selected ='selected'" }} @endif > {{ $name }}  </option>  
                    @endif
                @endforeach
        </select>
    </div>
</div>
