<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Faker\Factory as Faker;

// Models
use App\Models\Bnbs;
use App\Models\Rooms;
use App\Models\Orders;

class BnbsSeeder extends Seeder
{
     /**
     * 執行數據庫填充。
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        // 創建 5 個 Bnb 記錄
        Bnbs::factory()->count(5)->create()->each(function ($bnb) use ($faker) {
            // 對於每個 Bnb，創建 10 個 Room 記錄
            Rooms::factory()->count(10)->create(['bnb_id' => $bnb->id])->each(function ($room) use ($faker) {
                // 對於每個 Room，隨機創建一些訂單日期為 2023 年 5 月的訂單
                for ($i = 0; $i < 3; $i++) {
                    $checkInDate = Carbon::create(2023, 5, rand(1, 31));
                    Orders::factory()->create([
                        'bnb_id' => $room->bnb_id,
                        'room_id' => $room->id,
                        'currency' => $faker->randomElement(['TWD', 'USD', 'JPY']), // 隨 // 隨機貨幣
                        'check_in_date' => $checkInDate,
                        'check_out_date' => $checkInDate->addDays(rand(1, 5)), // 假設住宿幾天
                        'created_at' => $checkInDate, // 將創建時間設置為入住日期
                    ]);
                }
            });
        });
    }
}
