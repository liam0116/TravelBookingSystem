<?php
namespace App\Service;

use Illuminate\Support\Facades\Log;

/**
 * CurrencyService 類提供了貨幣轉換的業務邏輯。
 */
class CurrencyService
{
    /**
     * 根據指定的來源貨幣、目標貨幣和金額進行貨幣轉換。
     *
     * @param string $source 來源貨幣代碼（例如：'TWD', 'JPY', 'USD'）。
     * @param string $target 目標貨幣代碼（例如：'TWD', 'JPY', 'USD'）。
     * @param float $amount 轉換的金額。
     * @return \Illuminate\Http\JsonResponse 返回包含轉換後金額的 JSON 響應。
     */
    public function currencyConversion(string $source, string $target, int $amount)
    {
        // 匯率數據
        $rates = [
            'TWD' => ['TWD' => 1, 'JPY' => 3.669, 'USD' => 0.03281],
            'JPY' => ['TWD' => 0.26956, 'JPY' => 1, 'USD' => 0.00885],
            'USD' => ['TWD' => 30.444, 'JPY' => 111.801, 'USD' => 1]
        ];
        try {
            // 計算轉換金額
            $convertedAmount = round($amount * $rates[$source][$target], 2);

            // 格式化金額（添加千位分隔符）
            $convertedAmount = number_format($convertedAmount, 2);

            $response = response()->json(['success' => true, 'msg' => 'success', 'amount' => $convertedAmount], 200);
        } catch (\Exception $e) {
            // 處理其他類型的異常
            Log::error('General error', ['error' => $e->getMessage()]);
            $response = response()->json(['success' => false, 'msg' => 'An error occurred.'], 500);
        }

        return $response;
    }
}