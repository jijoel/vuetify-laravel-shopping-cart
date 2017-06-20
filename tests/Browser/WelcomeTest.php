<?php namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

use App\Product;

class WelcomeTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * @test
     */
    public function it_can_show_the_storefront()
    {
        factory(Product::class)->create();

        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                ->waitForText('Store')
                ->assertSee('Products')
                ->waitForText('ADD TO CART');
        });
    }
}
