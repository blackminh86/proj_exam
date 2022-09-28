<div>   
    @if(!empty($updown['up']))

    <button type="button" class="btn btn-primary btn-xs" data-url="{{ route($controllerName . '/updateMove') }}?up={{ $id }}&currentPage={{$currentPage}}" name="updown">
        <span class="glyphicon glyphicon-triangle-top" aria-hidden="true"></span>
    </button>
    @endif

    @if(!empty($updown['down']))
    <button type="button" class="btn btn-info btn-xs" data-url="{{ route($controllerName . '/updateMove') }}?down={{ $id }}&currentPage={{$currentPage}}" name="updown">
        <span class="glyphicon glyphicon-triangle-bottom" aria-hidden="true"></span>
    </button>
    @endif
</div>