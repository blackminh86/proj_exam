<div>
<button name="changeStatus" wire:click="changeStatus" type="button" class="btn btn-round @if ($status === 'active') btn-success @else btn-info @endif">@if ($status === 'active') Kích hoạt @else Chưa kích hoạt @endif</button>
</div>