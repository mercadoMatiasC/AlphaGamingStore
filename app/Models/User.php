<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'account_status' => 'boolean',
        ];
    }

    public function disable(){
        return $this->update(['account_status' => false]);
    }

    public function enable(){
        return $this->update(['account_status' => true]);
    }

    public function isActive(): bool {
        return $this->account_status;
    }

    public function role(){
        return $this->belongsTo(Role::class);
    }

    public function hasRole(string $role): bool {
        return $this->role?->name === $role;
    }

    public function hasAnyRole(array $roles): bool {
        return in_array($this->role?->name, $roles);
    }

    public function personal_IDSet(): bool{
        return !empty($this->personal_id);
    }

    public function orders(){
        return $this->hasMany(Order::class);
    }

    public function activeAddresses(){
        return $this->hasMany(ShippingAddress::class)->where('active', true);
    }

    public function shipping_addresses(){
        return $this->hasMany(ShippingAddress::class);
    }

    public function isAdmin(): bool {
        return $this->role->id === 2;
    }

    public function isOwner(): bool {
        return $this->role->id === 1;
    }

    public function isStaff(): bool {
        return $this->isAdmin() || $this->isOwner();
    }
}
