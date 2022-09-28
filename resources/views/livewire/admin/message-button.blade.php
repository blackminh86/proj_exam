
<div>
<button name="changeStatus" wire:click="changeStatus" type="button" class="btn btn-round @if ($status == 'unread') btn-danger @else btn-success @endif">@if ($status === 'unread') Chưa đọc @else Đã phản hồi @endif</button>
</div>