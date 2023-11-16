<?php
namespace App\Service;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

/**
 * BnbsService 类提供了与旅宿相关的业务逻辑。
 */
class BnbsService
{
    /**
     * 获取特定条件下排名前列的旅宿信息。
     *
     * @param string $currency 货币类型 (例如: 'TWD', 'JPY', 'USD')。
     * @param string $startDate 开始日期，格式为 'Y-m-d'。
     * @param string $endDate 结束日期，格式为 'Y-m-d'。
     * @param int $limit 返回结果的数量限制。
     * @return \Illuminate\Http\JsonResponse 返回包含旅宿信息的 JSON 响应。
     */
    public function getTopBnbs(string $currency, string $startDate, string $endDate, int $limit)
    {
        try {
            $query = "
                SELECT 
                    bnbs.id AS bnb_id, 
                    bnbs.name AS bnb_name, 
                    SUM(orders.amount) AS total_amount
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
                    total_amount DESC
                LIMIT ?
            ";
            $Data = DB::select($query, [$currency, $startDate, $endDate, $limit]);
            $response = response()->json(['success' => true, 'message' => 'Data retrieved successfully.', 'top_bnbs' => $Data], 200);
        } catch (\Illuminate\Database\QueryException $e) {
            // 处理数据库查询异常
            Log::error('Database query error', ['error' => $e->getMessage()]);
            $response = response()->json(['success' => false, 'message' => 'Database error occurred.'], 500);
        } catch (\Exception $e) {
            // 处理其他类型的异常
            Log::error('General error', ['error' => $e->getMessage()]);
            $response = response()->json(['success' => false, 'message' => 'An error occurred.'], 500);
        }

        return $response;
    }
}