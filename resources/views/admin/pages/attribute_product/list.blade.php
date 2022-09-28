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
                    <th class="column-title">Value</th>
                    <th class="column-title">Product</th>
                    <th class="column-title">Attribute</th>
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
                    <td width="25%">{{ $item->value}}</td>
                    <td width="25%">{{ $item->product->name}}</td>
                    <td width="25%">{{ $item->attribute->name}}</td>
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