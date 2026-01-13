<?php

namespace App\Models;

use App\Notifications\Mail\PasswordReset;
use Illuminate\Notifications\Notifiable;
use Lab404\Impersonate\Models\Impersonate;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Filament\Panel;
use Filament\Models\Contracts\FilamentUser;
use Illuminate\Foundation\Auth\User as Authenticatable;
use MWGuerra\FileManager\Models\FileSystemItem;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements JWTSubject, FilamentUser
{
    use Notifiable;
    use Impersonate;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'verification_code', 'verified',
    ];

    /**
     * The attributes that are added to the model's array form.
     */
    protected $appends = [
        'image_url',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function profile($key)
    {
        $keyValue = $this->keyValue($key);
        return $keyValue->value ?? '';
    }

    /**
     * Check if the user can access the Filament panel.
     * Uses Spatie's HasRoles trait hasRole() method
     *
     * @return bool
     */
    public function canAccessPanel(Panel $panel): bool
    {
        // Allow access to the Filament panel if the user is an admin
        // After migration, this will use Spatie's hasRole() method
        return $this->hasRole('admin');
    }

    public function hasAnnouncements()
    {
        // Get the latest Announcement
        $latest_announcement = Announcement::orderBy('created_at', 'DESC')->first();

        if (!$latest_announcement) {
            return false;
        }
        return !$this->announcements->contains($latest_announcement->id);
    }

    public function announcements()
    {
        return $this->belongsToMany(Announcement::class);
    }

    public function reports()
    {
        return $this->hasMany(Report::class)->without('user');
    }

    public function avatar()
    {
        return $this->morphToMany(FileSystemItem::class, 'model', 'file_has_models', 'model_id', 'file_id');
    }

    public function getImageUrlAttribute()
    {
        $avatar = $this->avatar()->where('file_type', 'image')->first();
        if ($avatar) {
            return asset('storage' . $avatar->getFullPath());
        }
        return null;
    }

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new PasswordReset($token));
    }

    public function scopeVerified($query)
    {
        return $query->where('verified', 1);
    }
}
