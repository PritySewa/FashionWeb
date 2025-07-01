<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Badge extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'icon_path',
        'description'
        ];

    public function products(){
        return $this->hasmany(Product::class);
    }
}



