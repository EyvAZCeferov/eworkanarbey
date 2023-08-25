<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StandartPages extends Model
{
    use HasFactory;
    protected $table='standart_pages';
    protected $fillable=[
        'name',
        'description',
        'type'
    ];
    protected $casts=[
        'name'=>"json",
        'description'=>"json",
    ];
}
