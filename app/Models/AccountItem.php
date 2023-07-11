<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountItem extends Model
{
    use HasFactory;

    protected $with = ['account', 'user',];


    // Generege referece from other account_item with the same account when boot
    protected static function booted()
    {
        static::creating(function ($accountItem) {
            //plus 1 to the last account_item reference of the same account
            $accountItem->reference = AccountItem::whereAccountId($accountItem->account_id)->max('reference') + 1;
        });
    }


    public function account()
    {
        return $this->belongsTo(Account::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
