<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    public function totoalMail()
    {
        return $this->hasMany(EmailList::class, 'group_id', 'id');
    }
}
