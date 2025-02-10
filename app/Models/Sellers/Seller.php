<?php

namespace App\Models\Sellers;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Stories\Store;
class Seller extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'password',
        'profile_picture',
        'address',
    ];

    protected $casts = [

'address' =>'array',
    ];


public function stories(){


return $this->hasMany(Store::class);

}

}
