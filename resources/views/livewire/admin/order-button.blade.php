@php
$items = [
'pending' => ['name' => 'Chờ xác nhận', 'class' => 'btn-danger'],
'shipping' => ['name' => 'Đang giao hàng', 'class' => 'btn-info'],
'delivered' => ['name' => 'Đã giao hàng', 'class' => 'btn-success'],
'received payment' => ['name' => 'Đã thanh toán', 'class' => 'btn-primary'],
'return' => ['name' => 'Đã chuyển hoàn', 'class' => 'btn-light'],
] ;
@endphp
<div>
    <button name="changeStatus" wire:click="changeStatus" type="button" class="btn btn-round {{ $items[$status]['class'] }}">{{ $items[$status]['name'] }}</button>
</div>
