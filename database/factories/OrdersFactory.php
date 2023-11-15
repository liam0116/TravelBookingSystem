<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
// models
use App\Models\Orders;
use App\Models\Bnbs;
use App\Models\Rooms;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Orders>
 */
class OrdersFactory extends Factory
{
    // 工廠關聯的model
    protected $model = Orders::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // 使用匿名函數和工廠方法創建關聯的 Bnbs 實例，並返回其 ID
            'bnb_id' => function () {
                return Bnbs::factory()->create()->id;
            },
            // 使用匿名函數和工廠方法創建關聯的 Rooms 實例，並返回其 ID
            'room_id' => function () {
                return Rooms::factory()->create()->id;
            },
            // 使用 Faker 生成貨幣代碼
            'currency' => $this->faker->randomElement(['TWD', 'USD', 'JPY']),
            // 使用 Faker 生成價格，範圍在 50 至 500 之間
            'amount' => $this->faker->randomFloat(2, 50, 500),
            // 使用 Faker 生成入住日期
            'check_in_date' => $this->faker->date,
            // 使用 Faker 生成退房日期
            'check_out_date' => $this->faker->date
        ];
    }
}
