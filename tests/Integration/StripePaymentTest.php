<?php namespace Tests\Feature;

use Tests\TestCase;
use Stripe\Stripe;
use Stripe\Charge;
use Stripe\Token;


/**
 * This is an integration test to make sure that we can
 * connect to the Stripe payment gateway with our app
 */
class StripePaymentTest extends TestCase
{
    /**
     * @test
     */
    public function we_can_make_a_payment_to_stripe()
    {
        Stripe::setApiKey(config('services.stripe.secret'));

        $token = Token::create([
            "card" => [
                "number" => "4242424242424242",
                "exp_month" => 12,
                "exp_year" => 2020,
                "cvc" => "314",
            ]
        ]);

        $charge = Charge::create([
            "amount" => 2000,
            "currency" => "usd",
            "source" => $token->id,
            "description" => "Charge for mysite.com",
        ]);

        $this->assertNotNull($charge);
        $this->assertTrue($charge->paid);
        $this->assertEquals('4242', $charge->source->last4);

        $json = $charge->__toJson();
        $this->assertContains('"last4": "4242"', $json);
    }

}
