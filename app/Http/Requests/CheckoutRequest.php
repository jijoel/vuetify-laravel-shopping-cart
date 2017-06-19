<?php namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Waavi\Sanitizer\Laravel\SanitizesInput;


class CheckoutRequest extends FormRequest
{
    use SanitizesInput;

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

    /**
     *  Filters to be applied to the input.
     *
     *  @return void
     */
    public function filters()
    {
        return [
            'name' => 'trim|escape|name',
            'email' => 'trim|escape|lower',
            'phone' => 'trim|escape|phone',
            'shipping.address' => 'trim|escape|address',
            'shipping.city' => 'trim|escape|city',
            'shipping.state' => 'trim|escape|state',
            'shipping.zip' => 'trim|escape|zip',
            'shipping.country' => 'trim|escape|country',
        ];
    }

}
