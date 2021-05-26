<?php

namespace Ecommecre\Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Ocart\Ecommerce\Providers\EcommerceServiceProvider;
use Ocart\PluginManagement\Plugin;
use Composer\Autoload\ClassLoader;
use Tests\TestCase;

class CreateProductTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
    }

    protected function setUpTraits()
    {
        parent::setUpTraits();
        $plugin = new Plugin();
        $plugin->activate('ecommerce');

        $loader = new ClassLoader();
        $loader->setPsr4('Ocart\\Ecommerce\\', plugin_path('ecommerce/src'));
        $loader->register(true);

        app()->register(EcommerceServiceProvider::class);

        $this->beforeApplicationDestroyed(function() use ($plugin) {
            $plugin->deactivate('ecommerce');
        });
    }

    public function test_product_create_screen_can_be_rendered()
    {

        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/admin/products/create');

        $response->assertStatus(200);
    }
}