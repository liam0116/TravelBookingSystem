<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BnbsControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/api/Bnbs/top?currency=TWD&start_date=2023-05-01&end_date=2023-05-31&limit=10');
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'success',
            'msg',
            'top_bnbs' => [
                '*' => ['bnb_id', 'bnb_name', 'may_amount']
            ]
        ]);
    }
}
