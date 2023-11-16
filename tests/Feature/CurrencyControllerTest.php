<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CurrencyControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/api/currency/convert?source=USD&target=JPY&amount=1525');

        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
            'msg' => 'success'
        ]);
        $response->assertJsonStructure([
            'success',
            'msg',
            'amount'
        ]);
    }
}
