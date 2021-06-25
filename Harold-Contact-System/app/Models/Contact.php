<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'company',
        'phone',
        'email',
        'user_id',
        'created_at',
        'updated_at'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function scopeSearch($query, $key)
    {
        $key_like = '%' . $key . '%';
        return $query->whereHas('name', function($q) use($key_like) {
            $q->where('company', 'like', $key_like);
        });
    }

}
