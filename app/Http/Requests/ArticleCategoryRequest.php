<?php

namespace App\Http\Requests;
use App\Rules\CheckNode;
use Illuminate\Foundation\Http\FormRequest;

class ArticleCategoryRequest extends FormRequest
{
    private $table            = 'article_categories';
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
        $id = $this->id;
        $condName  = "bail|required|between:5,100|unique:$this->table,name";

        if(!empty($id)){ // edit
            $condName  .= ",$id";
        }
        return [
            'name'        => $condName,
            'status'      => 'bail|in:active,inactive',
            'parent_id'      => ['required', new CheckNode($this->request->all())],
        ];
    }

    public function messages()
    {
        return [
            'parent' => 'Không thể chọn parent là con của Danh Mục này',
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
