@if ($paginator->hasPages())
<div class="pagination-container">
    <ul class="list-inline list-unstyled">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())

        @else
        <li class="prev"><a href="javascript:clickPage({{ $page-1 }})"><i class="fa fa-angle-left"></i></a></li>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
        {{-- Array Of Links --}}
        @if (is_array($element))
        @foreach ($element as $page => $url)
        @if ($page == $paginator->currentPage())
        <li class="active"><a href="javascript:clickPage({{ $page }})">{{ $page }}</a></li>
        @else
        <li><a href="javascript:clickPage({{ $page }})">{{ $page }}</a></li>
        @endif
        @endforeach
        @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
        <li class="next"><a href="javascript:clickPage({{ $page+1 }})"><i class="fa fa-angle-right"></i></a></li>
        @endif
    </ul>
</div>
@endif