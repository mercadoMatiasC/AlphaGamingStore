<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    /** @use HasFactory<\Database\Factories\RoleFactory> */
    use HasFactory;

    public const OWNER_ID = 1;
    public const ADMIN_ID = 2;
    public const CUSTOMER_ID = 3;

    protected $fillable = ['name'];

    public function users(){
        return $this->hasMany(User::class);
    }

    public function colour(){
        $colours = ['red', 'green', 'white'];
        return $colours[$this->id-1];
    }
}