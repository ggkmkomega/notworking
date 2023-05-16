<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $table = 'tickets';

    protected $fillable = [
        'user_id',
        'title',
        'type',
        'status',
        'closed_at',
        'created_at',
        'updated_at',
    ];

    public function Client(){
        return $this->hasOne(User::class, 'id', 'client_id');
    }

    public function Messages(){
        return $this->hasMany(Message::class, 'ticket_id', 'id');
    }
}
