<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attributes extends Model
{
    use HasFactory;
    protected $table='attributes';
    protected $fillable=[
        'name',
        'status',
        'type',
        'group_id',
    ];
    protected $casts=[
        'name'=>'json',
        'status'=>"boolean",
        'type'=>'string',
        'group_id'=>"integer"
    ];
    public function services(){
        return $this->hasMany(ServiceAttributes::class,'attribute_id','id')->orderBy('order_a','ASC');
    }
    public function group(){
        return $this->hasOne(Attributes::class,'id','group_id');
    }
}
