<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\HasUuid;

class Order extends Model
{
    use HasFactory, HasUuid;

    protected $table= 'order';
    protected $fillable = [
        'user_id',
        'order_no',
        'payment_method',
        'address_detail',
        'total_price',
        'status',
    ];

    protected $primaryKey = 'id';

    protected $keyType = 'string';

    public $incrementing = false;

    public function orderdetails()
    {
        return $this->hasMany(OrderDetail::class);
    }

    public function users()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }
}
