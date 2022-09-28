@php
use App\Helpers\Template as Template;
use App\Helpers\Hightlight as Hightlight;
use App\Models\ArticleCategory as Category;
$category = Category::withDepth()->where('id','>',1)->get()->pluck('name_with_depth_with_id','_lft');
@endphp
<div class="x_content">
    <div class="table-responsive">
        <table class="table table-striped jambo_table bulk_action">
            <thead>
                <tr class="headings">
                    <th class="column-title">#</th>
                    <th class="column-title">Article Info</th>
                    <th class="column-title">Thumb</th>
                    <th class="column-title">Category</th>
                    <th class="column-title">Kiểu bài viết</th>
                    <th class="column-title">Trạng thái</th>
                    {{-- <th class="column-title">Tạo mới</th>
                    <th class="column-title">Chỉnh sửa</th> --}}
                    <th class="column-title">Hành động</th>
                </tr>
            </thead>
            <tbody> 
                @if (count($items) > 0)
                @foreach ($items as $key => $item)
                @php
                $index = $key + 1;
                $class = ($index % 2 == 0) ? "even" : "odd";
                $id = $item->id;
                $name = Hightlight::show($item->name, $params['search'], 'name');
                $content = Hightlight::show($item->content, $params['search'], 'content');
                $thumb = Template::showItemThumb($controllerName, $item->thumb, $item->name);
                $modifiedHistory = Template::showItemHistory($item->modified_by, $item->updated_at);
                $listBtnAction = Template::showButtonAction($controllerName, $id);
                @endphp

                <tr class="{{ $class }} pointer">
                    <td>{{ $index }}</td>
                    <td width="30%">
                        <p><strong>Name:</strong> {!! $name !!}</p>
                        <!-- <p><strong>Content:</strong> {-- $content --}</p> -->
                    </td>
                    <td width="14%">
                        <p>{!! $thumb !!}</p>
                    </td>
                    <td>@livewire('admin.select-category', ['rowId' => $id ,'category'=>$category, 'categoryId' => $item->article_category_id , 'table' => $table])</td>
                    <td>@livewire('admin.article-select-display', ['rowId' => $id , 'type' => $item->type , 'controllerName' => $controllerName])</td>
                    <td>@livewire('admin.status-button', ['rowId' => $id , 'status' => $item->status , 'table' => $table])</td>
                    {{-- <td>{!! $modifiedHistory !!}</td> --}}
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