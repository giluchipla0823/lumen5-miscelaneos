<?php


namespace App\Http\Requests;

use App\Helpers\AppHelper;

class CategoryRequest extends BaseFormRequest
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
        $method = $this->method();

        if(in_array($method, ['POST', 'PUT'])){
          return $this->_rules();
        }

        return [];
    }

    private function _rules(){
        $id = $this->segment(3);

        return [
            'name' => $this->_getRuleName($id)
        ];
    }

    private function _getRuleName($id){
        $controller = AppHelper::getControllerInfo();

        $rule = 'required|max:50|unique:categories,name';

        if($controller['action'] === 'update'){
            $rule .= ',' . $id . ',id';
        }

        return $rule;
    }
}
