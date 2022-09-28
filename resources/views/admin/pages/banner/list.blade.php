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
                    <th class="column-title">Slider Info</th>
                    <th class="column-title">Loại</th>
                    <th class="column-title">Trạng thái</th>
                    <th class="column-title">Tạo mới</th>
                    <th class="column-title">Chỉnh sửa</th>
                    <th class="column-title">Hành động</th>
                </tr>
            </thead>
            <tbody>
                @if (count($items) > 0)
                    @foreach ($items as $key => $val)
                        @php
                            $index           = $key + 1;
                            $class           = ($index % 2 == 0) ? "even" : "odd";
                            $id              = $val['id'];
                            
                            $name            = Hightlight::show($val['name'], $params['search'], 'name');
                            $description     = Hightlight::show($val['description'], $params['search'], 'description');
                            $link            = Hightlight::show($val['link'], $params['search'], 'link');
                            $thumb           = Template::showItemThumb($controllerName, $val['thumb'], $val['name']);; 
                            $createdHistory  = Template::showItemHistory($val['created_by'], $val['created_at']);
                            $modifiedHistory = Template::showItemHistory($val['modified_by'], $val['updated_at']);
                            $listBtnAction   = Template::showButtonAction($controllerName, $id);
                        @endphp

                        <tr class="{{ $class }} pointer">
                            <td >{{ $index }}</td>
                            <td width="40%">
                                <p><strong>Name:</strong> {!! $name !!}</p>
                                <p><strong>Description:</strong> {!! $description!!}</p>
                                <p><strong>Link:</strong> {!! $link !!}</p>
                                <p>{!! $thumb !!}</p>
                            </td>
                            <td>@livewire('admin.banner-select-type', ['rowId' => $id , 'type' => $val['type'] , 'controllerName' => $controllerName])</td>
                            <td>@livewire('admin.status-button', ['rowId' => $id  , 'status' => $val['status'] , 'table' => $table])</td>
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
           