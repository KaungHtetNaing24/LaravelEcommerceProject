<?php

namespace App\Models;

use App\Models\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    
    use HasFactory, HasUuid;

    protected $table = 'categories';
    protected $fillable = ['name','slug','description'];

    protected $primaryKey = 'id';

    protected $keyType = 'string';

    public $incrementing = false;

    public function products()
    {
        return $this->hasMany(Product::class,'id','category_id');
    }
}
