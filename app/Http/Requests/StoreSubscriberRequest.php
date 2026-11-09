<?php

namespace App\Http\Requests;

use App\Rules\ValidHCaptcha;
use Illuminate\Foundation\Http\FormRequest;

class StoreSubscriberRequest extends FormRequest
{

    protected $errorBag = 'subscribers';

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'email' => 'required|email|unique:subscribers,email',
        ];

        if (env('APP_ENV') == 'production') {
            $rules['h-captcha-token'] = ['required', new ValidHCaptcha()];
        }
        return $rules;
    }
}
