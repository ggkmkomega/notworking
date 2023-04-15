<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \Awobaz\Compoships\Compoships;

class ProdImage extends Model
{
    use HasFactory;
    use Compoships;

    public function prod(){
        return $this->hasOne(Hardware::class, ['id', 'prod_category'], ['prod_id', 'prod_category']);
    }
}
