<?php

namespace CodeDelivery\Http\Requests;

use Illuminate\Http\Request as HttpRequest;

class CheckoutRequest extends Request
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
     * @param HttpRequest $request
     * @return array
     */
    public function rules(HttpRequest $request)
    {
        $rules = [
            'cupom_code' => 'exists:cupoms,code,used,0'
        ];
        $this->buildRulesItems(0, $rules);
        //pega items, se $items for null, retorna array []
        $items = $request->get('items', []);
        //confirma $items sendo array
        $items = !is_array($items)?[]:$items;
        //varre items para validar cada indice
        foreach($items as $key => $value){
            $this->buildRulesItems($key,$rules);
        }
        return $rules;
    }

    private function buildRulesItems($key, array &$rules){
        $rules["items.$key.product_id"] = 'required';
        $rules["items.$key.qtd"] = 'required';
    }
}
