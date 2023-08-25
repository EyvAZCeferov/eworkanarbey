<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceNotifications extends Model
{
    use HasFactory;
    protected $table='service_notifications';
    protected $fillable=[
        'user_id',
        'service_id',
        'name',
        'slugs',
        'description',
        'status',
        'pdf',
        'time'
    ];
    protected $casts=[
        'user_id'=>"integer",
        'service_id'=>"integer",
        'name'=>"json",
        'slugs'=>"json",
        'description'=>"json",
        'status'=>"boolean",
        // 'time'=>"timestamp"
    ];
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function service(){
        return $this->belongsTo(Services::class);
    }
    public function attributes(){
        return $this->hasMany(ServiceNotificationAttribute::class,'service_notification_id','id');
    }
}
