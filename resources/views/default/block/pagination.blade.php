@php 
$paginator = $products->appends(request()->input()) ;
@endphp
        {!! $paginator->links('pagination.pagination_frontend') !!}

