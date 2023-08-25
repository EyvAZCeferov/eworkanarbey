<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceNotificationAttribute extends Model
{
    use HasFactory;
    protected $table='service_notification_attributes';
    protected $fillable=[
        'service_notification_id',
        'attribute_group_id',
        'attribute_id'
    ];
    public function service(){
        return $this->belongsTo(Services::class);
    }
    public function attribute(){
        return $this->hasOne(Attributes::class,'id','attribute_id');
    }
    public function attributegroup(){
        return $this->hasOne(Attributes::class,'id','attribute_group_id');
    }
}
