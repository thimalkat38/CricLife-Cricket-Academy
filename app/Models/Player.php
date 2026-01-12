<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Player extends Model
{
    protected $fillable = [
        'player_id',
        'name',
        'dob',
        'gender',
        'school',
        'address',
        'p_name',
        'p_num',
        'num',
        'monthly_fee',
        'photo',
    ];

    /**
     * Boot the model.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($player) {
            if (empty($player->player_id)) {
                $player->player_id = static::generatePlayerId();
            }
        });
    }

    /**
     * Generate a unique player ID in the format CC0001, CC0002, etc.
     */
    protected static function generatePlayerId(): string
    {
        // Get all existing player IDs that match the pattern
        $existingIds = static::whereNotNull('player_id')
            ->where('player_id', 'like', 'CC%')
            ->pluck('player_id')
            ->toArray();

        $maxNumber = 0;
        
        // Extract numbers from existing IDs and find the maximum
        foreach ($existingIds as $id) {
            $number = (int) substr($id, 2);
            if ($number > $maxNumber) {
                $maxNumber = $number;
            }
        }

        // Increment and format the new ID
        $newNumber = $maxNumber + 1;
        return 'CC' . str_pad($newNumber, 4, '0', STR_PAD_LEFT);
    }

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
