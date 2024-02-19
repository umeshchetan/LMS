<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = "orders";

    protected $fillable = [
        "paymentid",
        "coursetype",
        "orderid",
        "courseid",
        "amount",
        "userid",
        "email",
        "status",
        "created_at",
        "expired_at" 
    ];

    public function getOrderDetails($userId){
        return $this->where('coursetype','main')->where('userid',$userId)->where('status','success')->orderBy('id','DESC')->first();
    }
}
