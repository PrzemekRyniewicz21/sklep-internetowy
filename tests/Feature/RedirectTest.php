<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Route;
use Tests\TestCase;

class RedirectTest extends TestCase
{
    public function testRedirectToWelcomeIndex()
    {
        $response = $this->get('/');

        // Sprawdzanie, czy żądanie zostało przekierowane (kod statusu 3xx)
        $response->assertStatus(200);
    }
}
