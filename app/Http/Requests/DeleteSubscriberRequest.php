<?php

namespace App\Http\Requests;

use App\Models\Subscriber;
use Illuminate\Foundation\Http\FormRequest;

class DeleteSubscriberRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => 'required|email|exists:subscribers,email',
        ];
    }

    public function subscriber()
    {
        return Subscriber::where('email', $this->input('email'))->firstOrFail();
    }
}
