@php
use App\Models\MenuModel ;
use App\Models\ProductCategory ;
use App\Models\ArticleCategory ;

$menu = MenuModel::withDepth()->where('id','>',1)->where('status' , 'active')->orderBy('_lft' , 'asc')->get()->toTree();
$product_categories = ProductCategory::withDepth()->where('id','>',1)->where('status' , 'active')->orderBy('_lft' , 'asc')->get()->toTree();
$article_categories = ArticleCategory::withDepth()->where('id','>',1)->where('status' , 'active')->orderBy('_lft' , 'asc')->get()->toTree();
@endphp
<div class="header-nav animate-dropdown">
    <div class="container">
        <div class="yamm navbar navbar-default" role="navigation">
            <div class="navbar-header">
                <button data-target="#mc-horizontal-menu-collapse" data-toggle="collapse" class="navbar-toggle collapsed" type="button">
                    <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
            </div>
            <div class="nav-bg-class">
                <div class="navbar-collapse collapse" id="mc-horizontal-menu-collapse">
                    <div class="nav-outer">
                        <ul class="nav navbar-nav">
                            <li class="dropdown hidden-sm"> <a href="{{ route('home') }}">Home</a> </li>
                            @foreach($menu as $item)
                            @if($item->type == 'product_categories' || $item->type == 'article_categories')
                            <li class="dropdown mega-menu">
                                <a href="{{ $item->link }}" data-hover="dropdown" class="dropdown-toggle" data-toggle="dropdown">{{ $item->name }}</a>
                                <ul class="dropdown-menu container">
                                    <li>
                                        <div class="yamm-content">
                                            <div class="row">
                                                @php 
                                                $categoryList = ($item->type == 'product_categories' ) ? $product_categories : $article_categories ;
                                                @endphp
                                                @foreach($categoryList as $category)
                                                <div class="col-xs-12 col-sm-12 col-md-2 col-menu">
                                                    <h2 class="title">{{$category->name}}</h2>
                                                    <ul class="links">
                                                    @foreach($category->children as $key => $categoryChild )
                                                        @if($key << 2 )
                                                        <li><a href="{{ route('productCategory.show' , ['slug'=> Str::slug($categoryChild -> name) , 'id'=>$categoryChild -> id ])}}">{{ $categoryChild -> name }}</a></li>
                                                        @endif    
                                                    @endforeach
                                                    </ul> 
                                                </div>
                                                @endforeach

                                                <!-- /.col -->
                                            </div>
                                            <!-- /.row -->
                                        </div>
                                        <!-- /.yamm-content -->
                                    </li>
                                </ul>
                            </li>
                            @endif

                            @if($item->type == 'link')
                            @if($item->link == '')
                            <li class="dropdown"> <a href="#" class="dropdown-toggle" data-hover="dropdown" data-toggle="dropdown">{{ $item->name }}</a>
                                <ul class="dropdown-menu pages">
                                    <li>
                                        <div class="yamm-content">
                                            <div class="row">
                                                <div class="col-xs-12 col-menu">
                                                    <ul class="links">
                                                        @foreach($item ->children as $children)
                                                        <li><a href="{{ $children->link }}" target="{{ $children->type_open }}">{{ $children->name }}</a></li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                            @else
                            <li class="dropdown hidden-sm"> <a href="{{ $item->link }}" target="{{ $item->type_open }}">{{ $item->name }}</a> </li>
                            @endif
                            @endif
                            @endforeach
                        </ul>
                        <!-- /.navbar-nav -->
                        <div class="clearfix"></div>
                    </div>
                    <!-- /.nav-outer -->
                </div>
                <!-- /.navbar-collapse -->

            </div>
            <!-- /.nav-bg-class -->
        </div>
        <!-- /.navbar-default -->
    </div>
    <!-- /.container-class -->

</div>