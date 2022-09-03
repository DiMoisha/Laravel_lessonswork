<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = "orders";
    protected $primaryKey = 'orderid';
    protected $fillable = ['orderid','sourceemail','customername','customertel','customeremail','description'];
}
