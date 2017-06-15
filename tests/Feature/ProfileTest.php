<?php namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Profile;


class ProfileTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * @test
     */
    public function it_returns_an_empty_list_of_profiles()
    {
        $response = $this->get('/api/profiles');

        $response->assertStatus(200)
            ->assertJson([]);
    }

    /**
     * @test
     */
    public function it_returns_found_profiles()
    {
        factory(Profile::class,5)->create();

        $response = $this->get('/api/profiles');

        $response->assertStatus(200);

        $this->assertCount(5, json_decode($response->getContent()));
    }

}
