<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Coach extends Model
{
    protected $fillable = [
        'name',
        'role',
        'gender',
        'nic',
        'qualifications',
        'num',
        'address',
        'photo',
        'salary',
    ];

    /**
     * Get the photo URL attribute.
     */
    public function getPhotoUrlAttribute()
    {
        if ($this->photo && Storage::disk('public')->exists($this->photo)) {
            return asset('storage/' . $this->photo);
        }
        return null;
    }
}
