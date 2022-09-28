@php
use App\Models\Product ;
use Illuminate\Support\Str;

$cart = Session::get('cart') ;
$sum = 0 ;
@endphp

<tbody bgcolor="#eee" style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px">

    @foreach($cart as $key => $item)
    @php
    $product = Product::find($item['product_id']);
    $total = ($item['quantity'] * $item['price']);
    $name = html_entity_decode($product->name) ;
    $url = route('product.show' , [ 'slug' => Str::slug($name) , 'id' => $item['product_id'] ]) ;
    @endphp
    <tr>
        <td align="left" style="padding:3px 9px" valign="top"><span><a href="{{ $url }}" >{{ $name }}</a></span><br>
        </td>
        <td align="left" style="padding:3px 9px" valign="top"><span>{{ $item['variable_name']}}</span></td>
        <td align="left" style="padding:3px 9px" valign="top"><span>{{ number_format($item['price']) }}đ</span></td>
        <td align="left" style="padding:3px 9px" valign="top">{{ number_format($item['quantity']) }}</td>
        <td align="right" style="padding:3px 9px" valign="top"><span>{{ number_format($total) }}đ</span></td>
    </tr>
    @php
    $sum += $total;
    @endphp
    @endforeach
</tbody>
<tfoot style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px">

    <tr bgcolor="#eee">
        <td align="right" colspan="4" style="padding:7px 9px"><strong><big>Tổng giá trị đơn hàng</big> </strong></td>
        <td align="right" style="padding:7px 9px"><strong><big><span>{{ number_format($sum) }}đ</span> </big> </strong></td>
    </tr>

</tfoot>