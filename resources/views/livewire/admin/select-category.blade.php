
<div>    
    <select name="select_change_attr" class="form-control" wire:model="categoryId"> 
        @foreach ($category as  $item)
        @php 
        $item = explode('_', $item);
        @endphp
       <option value="{{ $item[1] }}">{{ $item[0] }}</option>
        @endforeach    
    </select>
</div>