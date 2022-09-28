@php
use App\Helpers\Template as Template;
use App\Helpers\Hightlight as Hightlight;
@endphp

@if (count($items) > 0)
@foreach ($items as $key => $item)
@php
$index = $key + 1;
$class = ($index % 2 == 0) ? "even" : "odd";
$id = $item->id;
//$name = Hightlight::show($item->name, $params['search'], 'name');
$status = Template::showItemStatus($controllerName, $id, $item->status);
$isHome = Template::showItemIsHome($controllerName, $id, $item->is_home);
$display = Template::showItemSelect($controllerName, $id, $item->display, 'display');
$createdHistory = Template::showItemHistory($item->created_by, $item->created_at);
$modifiedHistory = Template::showItemHistory($item->modified_by, $item->update_at);
$listBtnAction = Template::showButtonAction($controllerName, $id);
$up = $item->getPrevSibling();
$down = $item->getNextSibling();
@endphp

<tr class="{{ $class }} pointer">
    <td>{{ $index }}</td>
    <td width="25%">{!! $item->name_with_depth !!}</td>
    <td>
        @if(!empty($up))
        <button type="button" class="btn btn-primary btn-xs" data-url="{{ route($controllerName . '/updateMove' ,['up' => $id  , 'currentPage'=> $currentPage]) }}" name="updown">
            <span class="glyphicon glyphicon-triangle-top" aria-hidden="true"></span>
        </button>
        @endif
        @if(!empty($down))
        <button type="button" class="btn btn-info btn-xs" data-url="{{ route($controllerName . '/updateMove' ,['down' => $id  , 'currentPage'=> $currentPage]) }}" name="updown">
            <span class="glyphicon glyphicon-triangle-bottom" aria-hidden="true"></span>
        </button>
        @endif
    </td>
    <td>{!! $status !!}</td>
    <td>{!! $isHome !!}</td>
    <td>{!! $display !!}</td>
    <td>{!! $createdHistory !!}</td>
    <td>{!! $modifiedHistory !!}</td>
    <td class="last">{!! $listBtnAction !!}</td>
</tr>
@endforeach
@else
@include('admin.templates.list_empty', ['colspan' => 6])
@endif