<?php

namespace App\Models;

use App\Models\User;
use App\Models\AccountItem;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Payment extends Model
{
    use HasFactory;
    protected $fillable = ["amount", "date", "via", "account_item_id", "user_id", "status", "reference", "nb_month"];

    public function account_item() {
        return $this->belongsTo(AccountItem::class);
    }

    public function user()  {
        return $this->belongsTo(User::class);
    }
}
