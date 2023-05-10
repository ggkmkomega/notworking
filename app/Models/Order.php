<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    
    protected $table = 'orders';

    protected $fillable = [
        'title',
        'client_id',
        'discription',
        'status',
        'order_status',
    ];

    public function Tasks(){
        return $this->hasMany(Task::class, 'order_id', 'id');
    }

    public function Invoice(){
        return $this->hasOne(Invoice::class, 'order_id', 'id');
    }

    public function Client(){
        return $this->hasOne(User::class, 'id', 'client_id');
    }
}
