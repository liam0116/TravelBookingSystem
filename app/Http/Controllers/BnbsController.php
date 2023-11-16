<?php
namespace App\Http\Controllers;

//Illuminate
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
// Service
use App\Service\BnbsService;

/**
 * BnbsController 負責處理與旅宿（Bnbs）相關的 HTTP 請求。
 */
class BnbsController extends Controller
{
    /**
     * 根據指定條件取得排名前列的旅宿資訊。
     *
     * @param Request $request 請求實例，包含查詢參數。
     * @param BnbsService $bnbsService 用於處理旅宿相關數據的服務。
     * @return \Illuminate\Http\JsonResponse 傳回查詢結果的 JSON 回應。
     */
    public function getTopBnbs(Request $request, BnbsService $bnbsService)
    {
        // 定義驗證規則
        $rules = [
            'currency' => 'required|in:TWD,JPY,USD',
            'start_date' => 'required|date|date_format:Y-m-d',
            'end_date' => 'required|date|date_format:Y-m-d|after_or_equal:start_date',
            'limit' => 'required|integer|min:1|max:30'
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
        $results = $bnbsService->getTopBnbs(
            $validatedData['currency'],
            $validatedData['start_date'],
            $validatedData['end_date'],
            $validatedData['limit']
        );

        return $results;
    }
}
