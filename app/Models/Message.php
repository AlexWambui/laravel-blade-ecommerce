<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Message extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone_number',
        'message',
        'status',
    ]; 

    public function getExcerptAttribute(): string
    {
        return Str::limit($this->message, 50, '...');
    }
}
