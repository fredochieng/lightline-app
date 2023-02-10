<?php

namespace Modules\MessageCenter\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ReferralEmails extends Model
{
    use HasFactory;

    protected $fillable = [];
    protected $table = 'user_referrals_mails';

    protected static function newFactory()
    {
        return \Modules\MessageCenter\Database\factories\ReferralEmailsFactory::new();
    }
}
