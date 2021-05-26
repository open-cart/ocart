<?php

namespace Tests\Feature\Page;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/admin/page');

        $response->assertStatus(200);
    }
}
