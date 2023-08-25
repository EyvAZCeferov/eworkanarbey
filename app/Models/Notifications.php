<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notifications extends Model
{
    use HasFactory;
    protected $table='notifications';
    protected $fillable=[
        'user_id',
        'value',
        'title',
        'body',
        'via',
        'status',
    ];
    protected $casts=[
        'user_id'=>'integer',
        'via'=>'integer',
        'status'=>"boolean"
    ];
    public function user(){
        return $this->belongsTo(User::class);
    }
}
