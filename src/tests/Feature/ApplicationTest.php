<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ApplicationTest extends TestCase
{
    /**
     * Test if application is running.
     *
     * @return void
     */
    public function testApplicationIsRunning()
    {
        $response = $this->get('/api/v1');

        $response->assertStatus(200);
    }
}
