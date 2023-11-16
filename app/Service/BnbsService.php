<?php
namespace App\Service;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use League\Flysystem\UnableToProvideChecksum;

class BnbsService
{
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