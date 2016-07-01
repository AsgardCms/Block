<?php

namespace Modules\Block\Http\Requests;

use Modules\Core\Internationalisation\BaseFormRequest;

class CreateBlockRequest extends BaseFormRequest
{
    public function translationRules()
    {
        return [
            'body' => 'required',
        ];
    }

    public function translationMessages()
    {
        return [
            'body.required' => trans('block::blocks.validation.body is required'),
        ];
    }

    public function rules()
    {
        return [
            'name' => 'required',
        ];
    }

    public function authorize()
    {
        return true;
    }

    public function messages()
    {
        return [];
    }
}
