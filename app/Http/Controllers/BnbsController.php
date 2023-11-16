<?php
namespace App\Http\Controllers;

//Illuminate
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Response;
// Service
use App\Service\BnbsService;

/**
 * BnbsController 負責處理與旅宿（Bnbs）相關的 HTTP 請求。
 */
class BnbsController extends Controller
{
    /**
     * 根据指定条件获取排名前列的旅宿信息。
     *
     * @param Request $request 请求实例，包含查询参数。
     * @param BnbsService $bnbsService 用于处理旅宿相关数据的服务。
     * @return \Illuminate\Http\JsonResponse 返回查询结果的 JSON 响应。
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
                'message' => $validator->errors()->first()
            ], 422);
        }

        // 進行業務邏輯處理
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
