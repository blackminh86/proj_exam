<?php

namespace App\Http\Requests;
use App\Rules\CheckNode;
use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    private $table            = 'products';
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'             => "bail|required|between:5,150",
            'status'           => 'bail|in:active,inactive',
            'product_category_id'      => 'bail|required|exists:product_categories,id',
        ];
    }

    public function messages()
    {
        return [
            //'parent' => 'Không thể chọn parent là con của Danh Mục này',
            // 'name.required' => 'Name không được rỗng',
            // 'name.min'      => 'Name :input chiều dài phải có ít nhất :min ký tứ',
        ];
    }
    public function attributes()
    {
        return [
            // 'description' => 'Field Description: ',
        ];
    }
}
