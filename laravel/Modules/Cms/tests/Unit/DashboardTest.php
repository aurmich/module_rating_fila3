<?php

declare(strict_types=1);

namespace Modules\Cms\Tests\Unit;

use Tests\TestCase;

class DashboardTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_route_home(): void
    {
        $testResponse = $this->get('/');

        $testResponse->assertSuccessful();
        $testResponse->assertViewIs('pub_theme::home');
    }

    /**
     * A basic test example.
     */
    public function test_route_login(): void
    {
        $testResponse = $this->get('/it/login');

        $testResponse->assertSuccessful();
        $testResponse->assertViewIs('pub_theme::auth.login');
    }
}
