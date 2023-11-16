<?php
namespace App\Service;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

/**
 * BnbsService 類提供了與旅宿相關的業務邏輯。
 */
class BnbsService
{
    /**
     * 取得特定條件下排名前列的旅宿資訊。
     *
     * @param string $currency 貨幣類型 (例如: 'TWD', 'JPY', 'USD')。
     * @param string $startDate 開始日期，格式為 'Y-m-d'。
     * @param string $endDate 結束日期，格式為 'Y-m-d'。
     * @param int $limit 傳回結果的數量限制。
     * @return \Illuminate\Http\JsonResponse 傳回包含旅宿資訊的 JSON 回應。
     */
    public function getTopBnbs(string $currency, string $startDate, string $endDate, int $limit)
    {
        try {
            $query = "
                SELECT 
                    bnbs.id AS bnb_id, 
                    bnbs.name AS bnb_name, 
                    SUM(orders.amount) AS may_amount
                FROM 
                    orders orders
                INNER JOIN 
                    bnbs bnbs ON orders.bnb_id = bnbs.id
                WHERE 
                    orders.currency = ? AND
                    orders.created_at BETWEEN ? AND ?
                GROUP BY 
                    bnbs.id, bnbs.name
                ORDER BY 
                    may_amount DESC
                LIMIT ?
            ";
            $Data = DB::select($query, [$currency, $startDate, $endDate, $limit]);
            foreach($Data as $key => $value){
                $formattedAmount = round($value->may_amount, 2); // 四舍五入到小数点第二位
                $value->may_amount = number_format($formattedAmount, 2); // 格式化为带有逗号的千分位
            }
            $response = response()->json(['success' => true, 'msg' => 'Data retrieved successfully.', 'top_bnbs' => $Data], 200);
        } catch (\Illuminate\Database\QueryException $e) {
            // 處理資料庫查詢異常
            Log::error('Database query error', ['error' => $e->getMessage()]);
            $response = response()->json(['success' => false, 'msg' => 'Database error occurred.'], 500);
        } catch (\Exception $e) {
            // 處理其他類型的異常
            Log::error('General error', ['error' => $e->getMessage()]);
            $response = response()->json(['success' => false, 'msg' => 'An error occurred.'], 500);
        }

        return $response;
    }
}