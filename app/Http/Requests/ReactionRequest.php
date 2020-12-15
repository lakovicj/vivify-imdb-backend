<?php

namespace App\Http\Requests;

use App\ReactionTypes;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ReactionRequest extends FormRequest
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
        return [
            'movie_id' => ['required', 'exists:movies,id'],
            'type' => ['required', 'string', Rule::in(ReactionTypes::$types)]
        ];
    }

    public function validationData()
    {
        return array_merge($this->all(), array('type' => strtolower($this->input('type'))));
    }
}
