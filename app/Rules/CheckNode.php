<?php

namespace App\Rules;
use App\Models\CategoriesModel ;
use Illuminate\Contracts\Validation\Rule;

class CheckNode implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($params)
    {
        $this->params = $params;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $bool = false ;
        if(!empty($params['id'])){
            $params = $this->params ;
            $node   = CategoriesModel::find($params['id']);
            $parent = CategoriesModel::find($params['parent_id']);
            $bool   = $node->isAncestorOf($parent);
        }
        $bool   = ($bool == true) ? false : true ;
        return  $bool ;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Không thể chọn parent là con của Danh Mục này.';
    }
}
