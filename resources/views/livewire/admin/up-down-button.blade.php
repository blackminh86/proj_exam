<div>
    @if(!empty($up))
    <button type="button" class="btn btn-primary btn-xs" wire:click="upPossion">
        <span class="glyphicon glyphicon-triangle-top" aria-hidden="true"></span>
    </button>
    @endif

    @if(!empty($down))
    <button type="button" class="btn btn-info btn-xs" wire:click="downPossion">
        <span class="glyphicon glyphicon-triangle-bottom" aria-hidden="true"></span>
    </button>
    @endif
</div>