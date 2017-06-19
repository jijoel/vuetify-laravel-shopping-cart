<?php namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Product;


class ProductTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @test
     */
    public function it_exists_and_can_be_found()
    {
        $fake = factory(Product::class)->make();
        $fake->save();

        $test = Product::find($fake->id);

        $this->assertNotNull($test);
        $this->assertEquals($fake->title, $test->title);
    }

}
