<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DonationMethod extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'donation_id',
        'type',
        'title',
        'bank_name',
        'branch',
        'routing_number',
        'account_name',
        'account_no',
        'platform',
        'platform_name',
        'merchant_type',
        'number',
        'order',
        'is_active',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'is_active' => 'boolean',
        'order' => 'integer',
    ];

    /**
     * Get the donation that owns the method.
     */
    public function donation()
    {
        return $this->belongsTo(Donation::class);
    }

    /**
     * Get the formatted details for bank accounts.
     */
    public function getDetailsAttribute()
    {
        if ($this->type === 'bank') {
            return [
                'bank_name' => $this->bank_name,
                'branch' => $this->branch,
                'routing_number' => $this->routing_number,
                'account_name' => $this->account_name,
                'account_no' => $this->account_no,
            ];
        }
        
        return null;
    }

    /**
     * Get the platform display name.
     */
    public function getDisplayPlatformAttribute()
    {
        if ($this->type === 'mobile') {
            $platforms = [
                'bkash' => 'bKash',
                'nogod' => 'নগদ',
                'rocket' => 'রকেট',
            ];
            
            return $platforms[$this->platform] ?? $this->platform_name;
        }
        
        return null;
    }

    /**
     * Scope a query to only include active methods.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope a query to only include bank methods.
     */
    public function scopeBank($query)
    {
        return $query->where('type', 'bank');
    }

    /**
     * Scope a query to only include mobile methods.
     */
    public function scopeMobile($query)
    {
        return $query->where('type', 'mobile');
    }

    /**
     * Scope a query to order by display order.
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('order', 'asc')
                     ->orderBy('created_at', 'asc');
    }
}