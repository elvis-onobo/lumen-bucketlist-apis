<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\ListItem;

class Bucketlist extends Model
{
    public function listitem()
    {
        return $this->hasMany(ListItem::class);
    }

}