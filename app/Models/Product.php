<?php

namespace App\Models;

use App\Models\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory, HasUuid;

    protected $table = 'product';

    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'description',
        'popular',
        'quantity',
        'original_price',
        'discount',
        'final_price',
        'image',
    ];

    protected $primaryKey = 'id';

    protected $keyType = 'string';

    public $incrementing = false;

    public function category()
    {
        return $this->belongsTo(Category::class,'category_id','id');
    }



}
