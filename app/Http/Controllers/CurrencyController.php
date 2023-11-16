<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
// Service
use App\Service\CurrencyService;

class CurrencyController extends Controller
{
    /**
     * 處理貨幣轉換請求。
     * 
     * 此方法接收 HTTP 請求並使用 CurrencyService 來執行貨幣轉換。
     * 它首先驗證請求參數是否符合預期，然後調用服務來執行轉換。
     * 最後，返回轉換結果的 JSON 響應。
     *
     * @param Request $request HTTP 請求實例，包含轉換所需的參數。
     * @param CurrencyService $currencyService 負責執行貨幣轉換邏輯的服務。
     * @return \Illuminate\Http\JsonResponse 包含轉換後金額的 JSON 響應。
     */
    public function convert(Request $request, CurrencyService $currencyService)
    {
        // 定義驗證規則
        $rules = [
            'source' => 'required|in:TWD,JPY,USD', // 來源貨幣必須是 TWD、JPY 或 USD
            'target' => 'required|in:TWD,JPY,USD', // 目標貨幣必須是 TWD、JPY 或 USD
            'amount' => 'required|numeric'         // 金額必須是數字
        ];

        // 創建驗證器實例
        $validator = Validator::make($request->all(), $rules);

        // 檢查驗證是否失敗
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'msg' => $validator->errors()->first()
            ], 422);
        }

        // 進行邏輯處理
        $validatedData = $validator->validated();
        $results = $currencyService->currencyConversion(
            $validatedData['source'],
            $validatedData['target'],
            $validatedData['amount']
        );

        return $results;
    }
}
