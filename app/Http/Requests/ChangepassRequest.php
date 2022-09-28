<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest; 
use App\Rules\CheckOldPass;
class ChangepassRequest extends FormRequest
{
    private $table            = 'user';
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
        $params = $this->request->all();
        return [
            'old_password' => ['required', new CheckOldPass($params['old_password'])],
            'password'     => "bail|required|between:5,100|confirmed",
        ];
    }
    public function messages()
    {
        
        return [
            'old_password' => $this->request->get('old_password'),
            // 'name.min'      => 'Name :input chiều dài phải có ít nhất :min ký tứ',
        ];
    }
}
