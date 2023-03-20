<?php

namespace Modules\Panel\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserDetails extends Model
{
    use HasFactory;

    protected $fillable = [];
    protected $table = 'user_details';

    protected static function newFactory()
    {
        return \Modules\Panel\Database\factories\UserDetailsFactory::new();
    }
}
