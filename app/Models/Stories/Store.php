<?php

namespace App\Models\Stories;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;


protected $fillable = [

    'name',
    'description',
    'seller_id',
    'image',
];

public function Images(){

return $this->hasMany(StoreImage::class);

}

}
