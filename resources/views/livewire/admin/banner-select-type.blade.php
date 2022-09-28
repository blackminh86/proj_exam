<div>
    <select name="select_change_attr" class="form-control" wire:model="type"> 
        @foreach ($items as $type => $value)
        <option value="{{ $type }}">{{ $value }}</option>
        @endforeach    
    </select>
</div>
