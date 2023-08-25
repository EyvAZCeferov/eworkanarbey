<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserServices extends Model
{
    use HasFactory;
    protected $table='user_services';
    protected $fillable=[
        'user_id',
        'service_id',
    ];
    protected $casts=[
        'user_id'=>"integer",
        'service_id'=>"integer",
    ];
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function service(){
        return $this->belongsTo(Services::class);
    }
}
