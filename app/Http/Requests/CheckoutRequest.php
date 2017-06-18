<?php namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class CheckoutRequest extends FormRequest
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
            'name' => 'required',
            'email' => 'required|email',
            'shipping.address' => 'required',
            'shipping.city' => 'required',
            'shipping.state' => 'required',
            'shipping.zip' => 'required',
            'shipping.country' => 'required',
            'stripe_token.id' => 'required',
        ];
    }
}
