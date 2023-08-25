<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payments extends Model
{
    use HasFactory;
    protected $table='payments';
    protected $fillable=[
        'user_id',
        'amount',
        'transaction_id',
        'payment_status',
        'data',
        'frompayment',
        'end_time',
    ];
    protected $casts=[
        'user_id'=>"integer",
        'payment_status'=>"integer",
        'data'=>"json",
        'frompayment'=>"json",
    ];
    public function user(){
        return $this->belongsTo(User::class);
    }
}
