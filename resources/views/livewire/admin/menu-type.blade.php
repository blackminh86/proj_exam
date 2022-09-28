<div>
    <select name="select_change_attr" class="form-control" wire:model="type">
        @foreach ($typeList as $type => $name)
        <option value="{{ $type }}" selected="selected">{{ $name }}</option>
        @endforeach
    </select>
</div>