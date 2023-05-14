<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \Awobaz\Compoships\Compoships;

class OrderList extends Model
{
    use HasFactory;
    use Compoships;

    protected $table = 'order_list';

    protected $fillable = [
        'order_id',
        'prod_id',
        'prod_category',
        'volume',
    ];

    public function Order(){
        return $this->hasOne(Order::class, 'id', 'order_id');
    }

    public function Product($category){
        switch ($category) {
            case 'software':
                return $this->hasOne(Software::class, ['id', 'prod_category'], ['prod_id', 'prod_category']);
                
            case 'hardware':
                return $this->hasOne(Hardware::class, ['id', 'prod_category'], ['prod_id', 'prod_category']);
                
            case 'service':
                return $this->hasOne(Service::class, ['id', 'prod_category'], ['prod_id', 'prod_category']);
                
            case 'course':
                return $this->hasOne(Course::class, ['id', 'prod_category'], ['prod_id', 'prod_category']);  
        }
    }
}
