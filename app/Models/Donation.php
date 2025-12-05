<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'subtitle',
        'main_image',
    ];

    /**
     * Get the donation methods.
     */
    public function donationMethods()
    {
        return $this->hasMany(DonationMethod::class);
    }

    /**
     * Get the main image URL.
     */
    public function getMainImageUrlAttribute()
    {
        if (!$this->main_image) {
            return asset('storage/images/donation/donate.png');
        }
        
        if (str_starts_with($this->main_image, 'http')) {
            return $this->main_image;
        }
        
        return asset('storage/' . $this->main_image);
    }

    /**
     * Scope a query to only include active donation methods.
     */
    public function scopeWithActiveMethods($query)
    {
        return $query->with(['donationMethods' => function ($query) {
            $query->where('is_active', true)
                  ->orderBy('order', 'asc')
                  ->orderBy('created_at', 'asc');
        }]);
    }
}