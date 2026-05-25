<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $table = 'profile';

    protected $primaryKey = 'id_profile';

    protected $fillable = [
        'profile',
        'cover_image',
        'id_user',
    ];

    protected $casts = [
        'id_user' => 'integer',
    ];

    public function user() {
        return $this->belongsTo(User::class, 'id_user');
    }
}
