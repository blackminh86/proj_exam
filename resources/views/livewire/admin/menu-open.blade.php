<div>
<div>
    <select name="select_change_attr" class="form-control" wire:model="typeOpen">
        @foreach ($typeOpenList as $typeOpen => $name)
        <option value="{{ $typeOpen }}" selected="selected">{{ $name }}</option>
        @endforeach
    </select>
</div>
</div>
