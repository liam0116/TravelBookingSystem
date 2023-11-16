<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Orders;

class OrderTest extends TestCase
{
    use RefreshDatabase; // 使用 RefreshDatabase Trait 清理數據庫

    /**
     * 測試訂單創建功能
     *
     * @return void
     */
    public function testOrderCreation()
    {
        // 使用工廠創建一個訂單實例
        $order = Orders::factory()->create();

        // 檢查數據庫中是否存在該訂單
        $this->assertDatabaseHas('orders', [
            'id' => $order->id
        ]);
    }
}
