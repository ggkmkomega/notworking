<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \Awobaz\Compoships\Compoships;

class Review extends Model
{
    use HasFactory;
    use Compoships;

    protected $table = 'reviews';

    protected $fillable = [
        'client_id',
        'prod_id',
        'prod_category',
        'stars',
        'review',
    ];
    
    public function Client(){
        return $this->hasOne(User::class, 'id', 'client_id');
    }

    public function Service(){
        return $this->hasOne(Service::class, ['id', 'prod_category'], ['prod_id', 'prod_category']);
    }

    public function Course(){
        return $this->hasOne(Course::class, ['id', 'prod_category'], ['prod_id', 'prod_category']);
    }
}
