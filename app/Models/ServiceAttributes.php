<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceAttributes extends Model
{
    use HasFactory;
    protected $table='service_attributes';
    protected $fillable=[
        'service_id',
        // 'attribute_id',
        'attribute_group_id',
        'showontable',
        'order_a'
    ];
    protected $casts=[
        'service_id'=>"integer",
        'attribute_group_id'=>"integer",
        // 'attribute_id'=>"integer",
        'showontable'=>"boolean",
        'order_a'=>"integer"
    ];
    public function service(){
        return $this->belongsTo(Services::class);
    }
    // public function attribute(){
    //     return $this->hasOne(Attributes::class,'id','attribute_id');
    // }
    public function attributegroup(){
        return $this->hasOne(Attributes::class,'id','attribute_group_id');
    }
}
