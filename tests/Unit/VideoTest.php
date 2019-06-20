<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class VideoTest extends TestCase
{
    use RefreshDatabase;
    use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();

        $this->seed('TestSeeder');
    }

    /**
     * Test for GET /videos
     *
     * @return void
     */
    public function testVideoIndexSuccess()
    {
        $this
            ->get('/api/videos?username=User1')
            ->assertStatus(200)
            ->assertJson([
                'status' => 'success',
                'data' => [
                    'total_size' => 450
                ]
            ]);
    }

    public function testVideoIndexFailure()
    {
        $this
            ->withHeaders([
                'Accept' => 'application/json',
            ])
            ->get('/api/videos?username=user1')
            ->assertStatus(422)
            ->assertJson([
                'message' => 'The given data was invalid.'
            ]);
    }

    public function testVideoShowSuccess()
    {
        $this
            ->get('/api/videos/Video1')
            ->assertStatus(200)
            ->assertJson([
                'status' => 'success',
                'data' => [
                    'id' => 'Video1',
                    'size' => '120',
                    'viewers' => '1100'
                ]
            ]);
    }

    public function testVideoShowFailure()
    {
        $this
            ->get('/api/videos/video1234')
            ->assertStatus(200)
            ->assertJson([
                'status' => 'error', 
                'message' => 'No query results for model [App\\Video] video1234'
            ]);
    }

    public function testVideoUpdateSuccess()
    {
        $this
            ->json('PATCH', '/api/videos/Video3', ['size' => 30, 'viewers' => 1000])
            ->assertStatus(200)
            ->assertJson([
                'status' => 'success',
                'data' => [
                    'id' => 'Video3',
                    'size' => 30,
                    'viewers' => 1000
                ]
            ]);
    }

    public function testVideoUpdateNotFoundFailure()
    {
        $this
            ->json('PATCH', '/api/videos/Video32', ['size' => 30, 'viewers' => 1000])
            ->assertStatus(200)
            ->assertJson([
                'status' => 'error', 
                'message' => 'No query results for model [App\\Video] Video32'
            ]);
    }

    public function testVideoUpdateSizeValidationFailure()
    {
        $this
            ->withHeaders([
                'Accept' => 'application/json',
            ])
            ->json('PATCH', '/api/videos/Video1', ['size' => '45fg30', 'viewers' => 1000])
            ->assertStatus(422)
            ->assertJsonFragment([
                'message' => 'The given data was invalid.'
            ]);
    }

    public function testVideoUpdateViewersValidationFailure()
    {
        $this
            ->withHeaders([
                'Accept' => 'application/json',
            ])
            ->json('PATCH', '/api/videos/Video1', ['size' => 50, 'viewers' => 'ten'])
            ->assertStatus(422)
            ->assertJsonFragment([
                'message' => 'The given data was invalid.'
            ]);
    }
}
