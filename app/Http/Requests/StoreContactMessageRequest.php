<?php

namespace App\Http\Requests;

use App\Rules\ValidHCaptcha;
use Illuminate\Foundation\Http\FormRequest;

class StoreContactMessageRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'subject' => ['nullable', 'string', 'max:255'],
            'message' => ['required', 'string', 'max:5000'],
        ];

        if (app()->environment('production')) {
            $rules['h-captcha-token'] = ['required', new ValidHCaptcha()];
        }

        return $rules;
    }
}
