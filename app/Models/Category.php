<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'categories';
    protected $primaryKey = 'id_category';    
    public $incrementing = true;   
    protected $keyType = 'int'; 
    public $timestamps = true;

    protected $fillable = [
        'name',
        'id_subcategory',
    ];

    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class, 'id_subcategory', 'id_subcategory');
    }
}
