<?php

namespace Modules\MessageCenter\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ContactUs extends Model
{
    use HasFactory;

    protected $fillable = [];
    protected $table = 'contact_us';
    
    protected static function newFactory()
    {
        return \Modules\MessageCenter\Database\factories\ContactUsFactory::new();
    }
}
