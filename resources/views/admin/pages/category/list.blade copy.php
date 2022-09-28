@php
use App\Helpers\Template as Template;
use App\Helpers\Hightlight as Hightlight;
@endphp
<div class="x_content">
    <div class="table-responsive">
        <table class="table table-striped jambo_table bulk_action">
            <thead>
                <tr class="headings">
                    <th class="column-title">#</th>
                    <th class="column-title">Name</th>
                    <th class="column-title">Trạng thái</th>
                    <th class="column-title">Hiện thị Home</th>]''
                    <th class="column-title">Kiểu hiện thị</th>
                    <th class="column-title">Tạo mới</th>
                    <th class="column-title">Chỉnh sửa</th>
                    <th class="column-title">Hành động</th>
                </tr>
            </thead>
            <tbody>
                @if (count($items) > 0)
                @foreach ($items as $key => $item)
                    @php
                    $index = $key + 1;
                    $class = ($index % 2 == 0) ? "even" : "odd";
                    $listBtnAction = Template::showButtonAction($controllerName, $item->id); 
                    @endphp
                @if($item->id >> 1)
                <tr class="{{ $class }} pointer">
                    <td>{{ $index }}</td>
                    <td width="25%">{{ $item->name_with_depth}}</td>
                    <td>@livewire('admin.status-button', ['rowId' => $item->id , 'status' => $item->status , 'table' => $table] )</td>
                    <td>@livewire('admin.is-home-button', ['rowId' => $item->id, 'is_home' => $item->is_home , 'table' => $table] )</td>
                    <td>@livewire('admin.category-select-display', ['rowId' => $item->id , 'display' => $item->display , 'table' => $table])</td>
                    <td>{{ $item->created_at }}</td>
                    <td>{{ $item->modified_at }}</td>
                    <td class="last">{!! $listBtnAction !!}</td>
                </tr>
                @endif
                @endforeach
                @else
                @include('admin.templates.list_empty', ['colspan' => 6])
                @endif
            </tbody>
        </table>
    </div>
</div>