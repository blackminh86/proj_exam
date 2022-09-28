@php
use Illuminate\Support\Str;
use App\Models\ProductCategory as Category;
$category_menu = Category::descendantsOf($category_id)->toTree();
$item = Category::find($category_id);
@endphp
<div class="sidebar-widget wow fadeInUp">
    <h3 class="section-title">{{ $item->name }}</h3>
    <div class="widget-header">
        <h4 class="widget-title">Category</h4>
    </div>
    <div class="sidebar-widget-body">
        <div class="accordion">
            <div class="accordion-group">
                <!-- Cutting -->
                @foreach($category_menu as $child)
                @if( count($child->children) >> 0 )
                <div class="accordion-heading"> <a href="#{{ $child->id }}" data-toggle="collapse" class="accordion-toggle collapsed"> {{ $child['name'] }} </a> </div>
                <!-- /.accordion-heading -->
                <div class="accordion-body collapse" id="{{ $child->id }}" style="height: 0px;">
                    <div class="accordion-inner">
                        <ul>
                            @foreach($child->children as $children)
                            <li><a href="{{ route($controllerName . '.show' , [ 'slug' => Str::slug($child->name) , 'id' => $child->id ] ) }}">{{ $children->name }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                    <!-- /.accordion-inner -->
                </div>
                <!-- /.accordion-body -->
                @else
                <div class="accordion-heading" class="accordion-toggle"><a href="{{ route($controllerName . '.show' , [ 'slug' => Str::slug($child->name) , 'id' => $child->id ] ) }}" > {{ $child->name }} </a> </div>
                @endif
                @endforeach
            </div>
            <!-- /.accordion-group -->
        </div>
        <!-- /.accordion -->
    </div>
    <!-- /.sidebar-widget-body -->
</div>