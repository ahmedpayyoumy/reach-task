<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdRequest extends FormRequest
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
            'type'          => ['required', 'in:free,paid'],
            'title'         => 'required',
            'description'   => 'required',
            'starts_date'   => ['required', 'date', 'after:today', 'date_format:Y/m/d'],
            'starts_time'   => ['required', 'date_format:H:i:s'],
            'tags'          => ['required', 'array'],
            'tags.*'        => ['required', 'exists:tags,id', 'distinct'],
            'category_id'   => ['required', 'exists:categories,id'],
            'advertiser_id' => ['required', 'exists:advertisers,id']
        ];
    }
}
