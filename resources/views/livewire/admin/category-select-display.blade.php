<div>
    <select name="select_change_attr" class="form-control"  wire:model="display"> 
        @foreach ($values as $display => $value)
         <option  value="{{ $display }}" >{{ $value }}</option>
        @endforeach    
    </select>
</div>