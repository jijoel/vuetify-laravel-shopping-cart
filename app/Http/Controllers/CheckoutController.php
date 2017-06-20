<?php namespace App\Http\Controllers;

use App\Http\Requests\CheckoutRequest;
use Stripe\Stripe;
use Stripe\Charge;

class CheckoutController extends Controller
{
    private $stripe;
    private $charge;

    function __construct(Stripe $stripe, Charge $charge)
    {
        $this->stripe = $stripe;
        $this->charge = $charge;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CheckoutRequest $request)
    {
        // verify the correct amount to pay

        // charge the card
        $this->stripe->setApiKey(config('services.stripe.secret'));
        $charge = $this->charge->create([
            "amount" => $request->get('total'),
            "currency" => "usd",
            "source" => $request->get('token.id'), // obtained with Stripe.js
            "description" => "Charge for mysite.com",
        ]);

        // record the order
        // remove the given item quantities from storage

        return $request->all();
    }
}
