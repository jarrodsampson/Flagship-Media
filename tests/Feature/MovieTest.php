<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Movie;

class MovieTest extends TestCase
{
    /**
     * Greeting Route.
     *
     * @return void
     */
    public function test_checkIfListRouteWorks()
    {
        $response = $this->get('/movies');
        $response->assertViewIs('movies.index');
        $response->assertStatus(200);
    }

    /**
     * Greeting Route.
     *
     * @return void
     */
    public function test_checkIfCreateRouteWorks()
    {
        $response = $this->get('/movies/create');
        $response->assertViewIs('movies.create');
        $response->assertStatus(200);
    }

    /**
     * Greeting Route.
     *
     * @return void
     */
    public function test_checkIfMovieCreation()
    {
        $response = $this->post('/movies', [
            'name' => 'Test Case',
            'genre' => 'Horror',
        ]);
        $response->assertRedirect('/movies');
    }

    /**
     * Greeting Route.
     *
     * @return void
     */
    public function test_checkIfMovieView()
    {
        // create new row in database
        $response = Movie::factory()->create(['name' => 'Test Movie View', 'genre' => 'Comedy']);

        $response = $this->get(
            route('movies.show', $response->id)
        );

        $response->assertStatus(200);
    }

    /**
     * Greeting Route.
     *
     * @return void
     */
    public function test_checkIfMovieEdit()
    {
        // create new row in database
        $response = Movie::factory()->create(['name' => 'Test Movie', 'genre' => 'Comedy']);

        $response = $this->put(
            route('movies.update', $response->id),
            [
                'name' => 'UPDATED',
                'genre' => 'YES',
            ],
        );

        $response->assertRedirect('/movies');
    }

    /**
     * Greeting Route.
     *
     * @return void
     */
    public function test_checkIfMovieDeletion()
    {
        // create new row in database
        $response = Movie::factory()->create(['name' => 'Deleted Movie', 'genre' => 'Comedy']);

        $response = $this->delete(
            route('movies.destroy', $response->id));

        $response->assertRedirect('/movies');
    }
}
