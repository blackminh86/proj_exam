@php
use App\Helpers\Template as Template;
use App\Helpers\Hightlight as Hightlight;
use Illuminate\Support\Str;
use App\Models\ProductCategory as Category;
$category = Category::withDepth()->where('id','>',1)->get()->pluck('name_with_depth_with_id','_lft');
@endphp
<div class="x_content">
    <div class="table-responsive">
        <table class="table table-striped jambo_table bulk_action">
            <thead>
                <tr class="headings">
                    <th class="column-title">#</th>
                    <th class="column-title">Product Info</th>
                    <th class="column-title">Thumb</th>
                    <th class="column-title">Category</th>
                    <th class="column-title">Giá bán</th>
                    <!-- <th class="column-title">Giá niêm yết</th> -->
                    <th class="column-title">Trạng thái</th>
                    <th class="column-title">Hiển thị trang chủ</th>
                    <!-- <th class="column-title">Tạo mới</th>
                    <th class="column-title">Chỉnh sửa</th> -->
                    <th class="column-title">Hành động</th>
                </tr>
            </thead>
            <tbody>
                @if (count($items) > 0)
                @foreach ($items as $key => $item)
                @php
                $index = $key + 1;
                $class = ($index % 2 == 0) ? "even" : "odd";
                $id = $item['id'];
     
                $name = Hightlight::show(html_entity_decode($item['name']), $params['search'], 'name' );
                $description = Hightlight::show(html_entity_decode($item['short_description']), $params['search'], 'content' );
                
                $thumb = null;
                if(!empty($item->images)){
                    $thumb = Template::showItemThumb($controllerName, json_decode($item->images)[0]->image, $item['name'] , $item->type);
                }
                

                $createdHistory = Template::showItemHistory($item['created_by'], $item['created_at']);
                $modifiedHistory = Template::showItemHistory($item['modified_by'], $item['updated_at']);
                $listBtnAction = Template::showButtonAction($controllerName, $id);
                @endphp

                <tr class="{{ $class }} pointer">
                    <td>{{ $index }}</td>
                    <td width="20%">
                        <p><strong>Name:</strong> <a href="{{ route($controllerName . '.show' ,['slug'=>'product' , 'id'=>$id]) }}" target="_blank">{!! $name !!}</a></p>
                        <p><strong>Description:</strong> {!! $description !!}</p>
                    </td>
                    <td width="14%">
                        <p>{!! $thumb !!}</p>
                    </td>
                    <td width="20%">@livewire('admin.select-category', ['rowId' => $id ,'category'=>$category, 'categoryId' => $item->product_category_id , 'table' => $table])</td>
                    <td>{{ $item['price'] }}</td>
                    <!-- <td>{{-- $item['list_price'] --}}</td> -->
                    <td>@livewire('admin.status-button', ['rowId' => $id , 'status' => $item['status'] , 'table' => $table])</td>
                    <td>@livewire('admin.product-select-display', ['rowId' => $id , 'display' => $item['display'] , 'controllerName' => $controllerName])</td>
                    <!-- <td>{{--$createdHistory --}}</td>
                    <td>{{-- $modifiedHistory --}}</td> -->
                    <td class="last">{!! $listBtnAction !!}</td>
                </tr>
                @endforeach
                @else
                @include('admin.templates.list_empty', ['colspan' => 6])
                @endif
            </tbody>
        </table>
    </div>
</div>