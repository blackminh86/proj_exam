<?php

namespace App\Http\Requests;
use Illuminate\Support\Facades\Session;
use Illuminate\Foundation\Http\FormRequest;
use App\Rules\PhoneNumber;

class CartRequest extends FormRequest
{
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
        Session::forget('shipping-info');
        $params = $this->request->all();
        $shippingInfo = [ 'fullname'=> $params['fullname'] , 'email'=> $params['email'] , 'address'=> $params['address'] , 'phone'=> $params['phone']] ;
        Session::put('shipping-info', $shippingInfo);
        return [
            'fullname' => 'required|min:2|max:100',
            'email'    => 'required|email:rfc,dns',
            'address'  => 'required|max:200',
            'phone'    => ['required',new PhoneNumber]
        ];
    }
    public function messages()
    {
        return [
            'fullname' => 'Please input min 2 characters and input max 100 characters ',
            'email'    => 'Please input an email validly',
            'address'  => 'Please input an email validly',
            'phone'    => 'Please input an email validly',
        ];
    }
}
