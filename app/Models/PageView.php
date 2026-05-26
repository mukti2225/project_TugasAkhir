<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PageView extends Model
{
    protected $fillable = [
        'url', 'ip_address', 'session_id', 'user_agent', 'referer',
    ];
}
