<?php

namespace Modules\Panel\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserPoint extends Model
{
    use HasFactory;

    protected $fillable = [];
    protected $table = 'user_points';

    protected static function newFactory()
    {
        return \Modules\Panel\Database\factories\UserPointFactory::new();
    }
}
