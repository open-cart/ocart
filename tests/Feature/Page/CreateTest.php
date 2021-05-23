<?php

namespace Tests\Feature\Page;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Ocart\Page\Models\Page;
use Tests\TestCase;

class CreateTest extends TestCase
{
    use RefreshDatabase;

    public function test_page_create_screen_can_be_rendered()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/admin/page/create');

        $response->assertStatus(200);
    }

    public function test_new_page_can_create()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/admin/page', [
            'name' => 'foo',
            'content' => 'bar',
            'submit' => 'save',
        ]);

        $page = Page::where('name', '=', 'foo')->first();

        $this->assertIsObject($page, 'Not create page');
        $response->assertRedirect(route('pages.index'));
    }
}
