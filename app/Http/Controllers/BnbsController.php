<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BnbsController extends Controller
{
    public function getTopBnbs()
    {
        $results = DB::select("
            SELECT 
                b.id AS bnb_id, 
                b.name AS bnb_name, 
                SUM(o.amount) AS may_amount
            FROM 
                orders o
            INNER JOIN 
                bnbs b ON o.bnb_id = b.id
            WHERE 
                o.currency = 'TWD' AND
                o.created_at >= '2023-05-01' AND
                o.created_at < '2023-06-01'
            GROUP BY 
                b.id, b.name
            ORDER BY 
                may_amount DESC
            LIMIT 10
        ");

        return response()->json($results);
    }
}
