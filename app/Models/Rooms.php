<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rooms extends Model
{
    use HasFactory;

    /**
     * @var string 数据表名
     */
    protected $table = 'rooms';

    /**
     * @var int 主键
     */
    protected $primaryKey = 'id';

    /**
     * @var array 可批量赋值的属性
     */
    protected $fillable = [];

    /**
     * @var bool 是否启用时间戳
     */
    public $timestamps = false;
}
