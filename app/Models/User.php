<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Filament\Models\Contracts\FilamentUser;
use Filament\Models\Contracts\HasAvatar;
use Filament\Models\Contracts\HasName;

class User extends Authenticatable implements FilamentUser, HasAvatar, HasName
{
    use Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'profile_image',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Allow all users to access the Filament panel
     */
    public function canAccessPanel(\Filament\Panel $panel): bool
    {
        return true;
    }

    /**
     * Show the display name in Filament header
     */
    public function getFilamentName(): string
    {
        return $this->name ?? $this->email;
    }

    /**
     * Avatar for Filament user (logo fallback)
     */
    public function getFilamentAvatarUrl(): ?string
    {
        // Use per-user uploaded image if available
        if (! empty($this->profile_image)) {
            return asset('storage/' . ltrim($this->profile_image, '/'));
        }

        // Otherwise, fall back to Morocco Quest logo
        return 'https://morocco-quest.com/favicon.ico';
    }

    /**
     * Custom attribute to check if user is admin
     */
    public function getIsAdminAttribute(): bool
    {
        return $this->role === 'admin' || $this->email === 'mounir.akajia@gmail.com';
    }

    /**
     * Accounts allowed to see the leads funnel: the WhatsApp/phone click
     * counters, the inquiry-email totals and the Leads resource in the
     * sidebar.
     *
     * Deliberately an explicit allow-list rather than a role check: the leads
     * data is commercially sensitive and every other panel user — including
     * the `admin` role — must not see it. Add an address here to grant access.
     */
    public const LEAD_VIEWERS = [
        'rochdi.karouali1234@gmail.com',
    ];

    public function canViewLeadStats(): bool
    {
        return in_array(strtolower(trim((string) $this->email)), self::LEAD_VIEWERS, true);
    }
}
