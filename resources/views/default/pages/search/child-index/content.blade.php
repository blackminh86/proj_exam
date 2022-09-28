
@if(isset($maxPage) && $maxPage != null)
<input type="hidden" name="maxPage" value="{{ $maxPage }}">
@else
<input type="hidden" name="maxPage" value="">
@endif

    @include('default.pages.category.child-index.category_grid')
    @include('default.pages.category.child-index.category_list')
