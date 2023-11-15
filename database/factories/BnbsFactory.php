<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
// Models
use App\Models\Bnbs;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Bnbs>
 */
class BnbsFactory extends Factory
{
    // 工廠關聯的model
    protected $model = Bnbs::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // 使用 Faker 生成假的旅宿名稱
            'name' => $this->faker->company
        ];
    }
}
