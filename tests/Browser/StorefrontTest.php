<?php namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

use App\Product;


class StorefrontTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * @test
     */
    public function it_can_add_and_remove_items_from_the_cart()
    {
        $item = factory(Product::class)->create([
            'price' => 1000,
            'shipping' => 100,
            'inventory' => 2,
        ]);

        $this->browse(function (Browser $browser) use($item) {
            // Let the page load
            $browser->visit('/')
                ->waitForText('Store')
                ->assertSee('Products');

            // See the item
            $browser->waitForText('ADD TO CART')
                ->assertSee($item->title)
                ->assertSee('$10.00', 'card');

            // Add an item to the cart
            $browser->assertSee('Stock: 2')
                ->press('ADD TO CART')
                ->assertSee('Stock: 1')
                ->assertSee('CHECK OUT')
                ->assertSee('Subtotal (1 item')
                ->assertSee('$10.00', 'td')
                ->assertSee('$1.00', 'td')   //shipping
                ->assertSee('$0.41', 'td')   //taxes
                ->assertSee('$11.41', 'td'); // grand total

            // add all items to the cart
            $browser->press('ADD TO CART')
                ->assertSee('SOLD OUT')
                ->assertSee('Stock: 0')
                ->assertSee('Subtotal (2 items')
                ->assertSee('$20.00', 'td')
                ->assertSee('22.83', 'td');  // grand total

            // Remove the items from the cart
            $browser->press('close', 'btn')
                ->assertSee('Stock: 2')
                ->assertDontSee('SOLD OUT')
                ->assertDontSee('CHECK OUT');
        });
    }

    /**
     * @test
     * @group now
     */
    public function it_can_search_for_items()
    {
        factory(Product::class)->create(['title' => 'Foo Bar']);
        factory(Product::class)->create(['title' => 'Boo']);
        factory(Product::class)->create(['title' => 'Fizz']);

        $this->browse(function (Browser $browser) {
            // Let the page load
            $browser->visit('/')
                ->waitForText('ADD TO CART');

            $browser->assertSee('Foo')
                ->assertSee('Boo')
                ->assertSee('Fizz');

            $browser->keys('#product-search', 'F')
                ->pause(300)
                ->assertSee('Foo')
                ->assertSee('Fizz')
                ->assertDontSee('Boo');

            $browser->keys('#product-search', 'Fo')
                ->pause(300)
                ->assertSee('Foo')
                ->assertDontSee('Fizz')
                ->assertDontSee('Boo');
        });
    }

    /**
     * @test
     */
    public function it_returns_errors_if_checkout_data_not_entered()
    {
        factory(Product::class)->create();

        $this->browse(function (Browser $browser) {
            // Let the page load
            $browser->visit('/')
                ->waitForText('ADD TO CART')
                ->press('ADD TO CART');

            // Currently, this does not work due to a bug in vuetify
            // $browser->press('CHECK OUT')
            //     ->waitForText('Check Out', '.dialog')
            //     ->press('PURCHASE')
            //     ->assertSee('Please enter your name');
        });
    }
}
