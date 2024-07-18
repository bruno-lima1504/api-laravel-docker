<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'subcategories';
    protected $primaryKey = 'id_subcategory';    
    public $incrementing = true;   
    protected $keyType = 'int'; 
    public $timestamps = true;

    protected $fillable = [
        'name',        
    ];

    public function categories()
    {
        return $this->hasMany(Category::class, 'id_subcategory', 'id_subcategory');
    }
}
