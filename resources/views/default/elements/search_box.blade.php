@php 
$breadcumb = (isset ($breadcumb )) ? $breadcumb : [1 => 'Categories'] ;
$searchCategory = (!isset($category_id) || $category_id == 1) ? 'Categories' : $breadcumb[$category_id]  ;
@endphp
<div class="search-area">
    <form name="search-box" id="search-box" method="Get" action="{{ route('keyword.search_product')}}">
        <div class="control-group">
            <ul class="categories-filter animate-dropdown">
                <li class="dropdown"> <a  class="dropdown-toggle" data-toggle="dropdown" href="#"><span id="option_search">{{ $searchCategory }}</span> <b class="caret"></b></a>
                    <ul class="dropdown-menu" role="menu">
                    <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:;" onclick="searchOption(1,'Categories')">Categories</a></li>
                        @foreach($breadcumb as $key => $value)
                        @if($key != 1)
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:;" onclick="searchOption('{{ $key }}','{{ $value }}')">- {{ $value }}</a></li>
                        @endif
                        @endforeach  
                    </ul>
                </li>
            </ul> 
            <input name='keyword' class="search-field" placeholder="Search here..." />
            <input id="search_category_id" name="category_id" type="hidden" value="{{ (isset($category_id)) ? $category_id : 1}}"/>
            <button class="search-button"></button>       
        </div>
    </form>
</div>