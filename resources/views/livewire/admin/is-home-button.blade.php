<div>
<button name="changeStatus" wire:click="changeIshome" type="button" class="btn btn-round @if ($is_home === 'yes')  btn-primary @else btn-warning @endif">@if ($is_home === 'yes') Hiển thị @else Không hiển thị @endif</button>

</div>
