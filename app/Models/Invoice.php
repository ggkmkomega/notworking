<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \Awobaz\Compoships\Compoships;

class Invoice extends Model
{
    use HasFactory;
    use Compoships;
    
    protected $table = 'Invoice';

    protected $fillable = [
        'order_id',
        'total_price',
        'payment_date',
    ];

    public function Order(){
        return $this->hasOne(Order::class, 'id', 'order_id');
    }

}