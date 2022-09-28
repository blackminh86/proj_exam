@php
use App\Helpers\Form as FormTemplate;
use Illuminate\Support\Facades\DB;
$attribute = DB::table('attributes')->select('name', 'id')->where('product_id' , $id)->get();
@endphp
<div class="form-group">
    <div class="col-md-6 col-sm-6 col-xs-6">
        <span class="btn btn-success" id="add-attr">Add an attribute</span>
        <span class="btn btn-primary" id='save-attr'>Create Variation</span>
    </div>
</div>
@foreach($attribute as $key => $value)
<div class="form-group attribute-product">
    <div class="col-md-2 col-sm-2 col-xs-2">
        <input type="text" class="form-control" name="attribute_name[]" value="{{ $value->name }}">
    </div>
    <div class="col-md-6 col-sm-6 col-xs-6">
        <textarea class="form-control tag_name" name="attribute_value[]" id="attr_id_{{ $value->id }}">
            @php
                $attributeProduct = DB::table('attribute_products')->select('value')->where('attribute_id' , $value->id)->get();
                echo json_encode($attributeProduct) ;
            @endphp    
    </textarea>
    </div>
    <span class="btn btn-danger btn-delete-attr">x</span>
</div>
@endforeach