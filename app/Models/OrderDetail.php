<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\HasUuid;

class OrderDetail extends Model
{
    use HasFactory, HasUuid;

    protected $table= 'order_detail';
    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'price',
        ];

        protected $primaryKey = 'id';

        protected $keyType = 'string';
    
        public $incrementing = false;

        public function products()
        {
            return $this->belongsTo(Product::class,'product_id','id');
        }
}
