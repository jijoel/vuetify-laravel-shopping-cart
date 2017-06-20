<?php namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Faker\Factory as FakerFactory;
use Mockery;


class CheckoutTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @test
     */
    public function it_returns_an_error_if_missing_all_data()
    {
        $this->postJson('/api/checkout', [])
            ->assertStatus(422);
    }

    /**
     * @test
     * @dataProvider getInvalidAttributes
     */
    public function it_returns_an_error_if_missing_required_data($input)
    {
        $this->postJson(
            '/api/checkout',
            $this->getFakeCheckout($input)
        )->assertStatus(422);
    }

    public function getInvalidAttributes()
    {
        return array(
            [['name'=>null]],
            [['email'=>null]],
            [['email'=>'foo']],
            [['shipping'=>['address'=>null]]],
            [['shipping'=>['city'=>null]]],
            [['shipping'=>['state'=>null]]],
            [['shipping'=>['zip'=>null]]],
            [['shipping'=>['country'=>null]]],
            [['stripe_token'=>[]]],  // must have token id
            [['items'=>[]]],  // must have items
            [['total'=>null]],
        );
    }

    /**
     * @test
     */
    public function it_can_successfully_check_out()
    {
        $stripe = Mockery::mock('Stripe\Stripe')
            ->shouldReceive('setApiKey')->once()
            ->getMock();
        app()->instance('Stripe\Stripe', $stripe);

        $charge = Mockery::mock('Stripe\Charge')
            ->shouldReceive('create')->once()
            ->with(Mockery::subset([ 'amount' => 2400]))
            ->getMock();
        app()->instance('Stripe\Charge', $charge);

        $this->postJson(
            '/api/checkout',
            $this->getFakeCheckout(['total' => 2400])
        )->assertStatus(200);
    }

    public function getFakeCheckout($input = [])
    {
        $faker = FakerFactory::create();

        return array_merge([
            'name' => $faker->name,
            'email' => $faker->safeEmail,
            'shipping' => [
                'address' => $faker->streetAddress,
                'city' => $faker->city,
                'state' => $faker->stateAbbr,
                'zip' => $faker->postCode,
                'country' => $faker->countryCode,
            ],
            'stripe_token' => [
                'id' => 'tok_' . $faker->text(10),
                'livemode' => false,
                'card' => [
                    'id' => 'card_' . $faker->text(10),
                    'brand' => $faker->creditCardType,
                    'exp_month' => $faker->month,
                    'exp_year' => $faker->year,
                    'last4' => $faker->randomNumber(4),
                ]
            ],
            'items' => [
                [ 'id' => 1, 'quantity' => 1 ],
            ],
            'total' => $faker->biasedNumberBetween(1, 200000, 'cos'),
        ], $input);
    }

}
