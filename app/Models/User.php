<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model {
    use HasFactory;

    protected $fillable = ['name', 'email'];

    public function details() {
        return $this->hasOne(UserDetail::class);
    }

    public function location() {
        return $this->hasOne(UserLocation::class);
    }
}