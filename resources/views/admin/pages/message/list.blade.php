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
                    <th class="column-title">Title</th>
                    <th class="column-title">Trạng thái</th>
                    <th class="column-title">Tạo mới</th>
                    <th class="column-title">Chỉnh sửa</th>
                    <th class="column-title">Hành động</th>
                </tr>
            </thead>
            <tbody>
                @if (count($items) > 0)
                @foreach ($items as $key => $item)
                dd($item);
                @php
                $index = $key + 1;
                $class = ($index % 2 == 0) ? "even" : "odd";
                $id = $item->id;
                $status = Template::showItemStatus($controllerName, $id, $item->status);
                $createdHistory = Template::showItemHistory($item->created_by, $item->created_at);
                $modifiedHistory = Template::showItemHistory($item->modified_by, $item->update_at);
                $listBtnAction = Template::showButtonAction($controllerName, $id);

                @endphp

                <tr class="{{ $class }} pointer">
                    <td>{{ $index }}</td>
                    <td width="25%">{{ $item->title }}</td>
                    <td>@livewire('admin.message-button', ['rowId' => $id , 'status' => $item['status']])</td>
                    <td>{!! $createdHistory !!}</td>
                    <td>{!! $modifiedHistory !!}</td>
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