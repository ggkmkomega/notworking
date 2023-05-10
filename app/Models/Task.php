<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \Awobaz\Compoships\Compoships;

class Task extends Model
{
    use HasFactory;
    use Compoships;
    
    protected $table = 'tasks';

    protected $fillable = [
        'order_id',
        'title',
        'group',
        'is_done',
        'cost',
    ];

    public function Order(){
        return $this->hasOne(Order::class, 'id', 'order_id');
    }

}
