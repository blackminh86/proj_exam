@php
use App\Helpers\Template as Template;
@endphp
<div class="x_content">
    <div class="table-responsive">
        <table class="table table-striped jambo_table bulk_action">
            <thead>
                <tr class="headings">
                    <th class="column-title">#</th>
                    <th class="column-title">Name</th>
                    <th class="column-title">Sắp xếp</th>
                    <th class="column-title">Trạng thái</th>
                    <th class="column-title">Hiện thị Home</th>
                    <th class="column-title">Kiểu hiện thị</th>
                    <th class="column-title">Tạo mới</th>
                    <th class="column-title">Chỉnh sửa</th>
                    <th class="column-title">Hành động</th>
                </tr>
            </thead>
            <tbody>
                @if ($items != null && count($items) >> 0)
                @foreach ($items as $key => $item)        
                @php
                $index = $key + 1;
                $class = ($index % 2 == 0) ? "even" : "odd";
                $listBtnAction = Template::showButtonAction($controllerName, $item['id']);
                $display = $item['display'];

                //$updown = [] ;
                //$updown['up'] = $item->getPrevSibling();
                //$updown['down'] = $item->getNextSibling();
                @endphp
                @if($item['id'] >> 1)
                <tr class="{{ $class }} pointer">
                    <td>{{ $index }}</td>
                    <td width="25%">{{ $item['name']}}</td>
                    <td>
                        @if(!empty($updown['up']))
                        <button wire:click="up" type="button" class="btn btn-primary btn-xs"  name="updown">
                            <span class="glyphicon glyphicon-triangle-top" aria-hidden="true"></span>
                        </button>
                        @endif
                        @if(!empty($updown['down']))
                        <button wire:click="down" type="button" class="btn btn-info btn-xs"  name="updown">
                            <span class="glyphicon glyphicon-triangle-bottom" aria-hidden="true"></span>
                        </button>
                        @endif

                    </td>
                    <td>
                        {{ $item['status']  }}
                        <button name="changeStatus" wire:click="changeStatus( {{ $key }} , {{ $item['id'] }} , '{{ $item['status'] }}')" type="button" class="btn btn-round @if ($item['status'] === 'active') btn-success @else btn-info @endif">@if ($item['status'] === 'active') Kích hoạt @else Chưa kích hoạt @endif</button>
                    </td>
                    <td>
                        <button name="changeStatus" wire:click="changeIshome( {{ $item['id']  }} , '{{ $item['is_home'] }}')" type="button" class="btn btn-round @if ($item['is_home'] === 'yes')  btn-primary @else btn-warning @endif">@if ($item['is_home'] === 'yes') Hiển thị @else Không hiển thị @endif</button>
                    </td>
                    <td>
                    <select class="form-control" wire:model="display" name="display">
                        @foreach($values as $key => $option)
                        <option value="{{ $key }}" >{{ $option }}</option>
                        @endforeach
                    </td>
                    <td>{{ $item['created_at'] }}</td>
                    <td>{{ $item['updated_at'] }}</td>
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