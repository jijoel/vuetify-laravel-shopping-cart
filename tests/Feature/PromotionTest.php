<?php namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Promotion;


class PromotionTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * @test
     */
    public function it_returns_an_empty_list_of_promotions()
    {
        $response = $this->get('/api/promotions');

        $response->assertStatus(200)
            ->assertJson([]);
    }

    /**
     * @test
     */
    public function it_returns_found_promotions()
    {
        factory(Promotion::class,5)->create();

        $response = $this->get('/api/promotions');

        $response->assertStatus(200);

        $this->assertCount(5, json_decode($response->getContent()));
    }

}
