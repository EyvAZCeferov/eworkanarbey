<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDevices extends Model
{
    use HasFactory;
    protected $table='user_devices';
    protected $fillable=[
        'user_id',
        'ipaddress',
        'device_data',
        'address_data',
        'status',
    ];
    protected $casts=[
        'user_id'=>"integer",
        'device_data'=>"json",
        "address_data"=>"json",
        "status"=>"boolean"
    ];
    public function user(){
        return $this->belongsTo(User::class);
    }
}
