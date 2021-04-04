<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function user(){

        return $this->belongsTo(User::class);
    }

    public function profileImage(){
        $imagePATH = ($this->image) ? $this->image: 'profile/imU4w5rRUMa2F25oLuh77Fi7wz0seyPpwM2f3pPl.png';

        return  '/storage/' .  $imagePATH;

    }

    public function followers(){

        return $this->belongsToMany(User::class);
    }

}
