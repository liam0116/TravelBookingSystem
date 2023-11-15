<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
// models
use App\Models\Rooms;
use App\Models\Bnbs;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Rooms>
 */
class RoomsFactory extends Factory
{
    // 工廠關聯的model
    protected $model = Rooms::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // 使用 Faker 生成假的房間名稱
            'name' => $this->faker->word,
            // 使用匿名函數和工廠方法創建關聯的 Bnbs 實例，並返回其 ID
            'bnb_id' => function () {
                return Bnbs::factory()->create()->id;
            }
        ];
    }
}
