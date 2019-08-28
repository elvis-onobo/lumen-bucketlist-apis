<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Bucketlist;

class ListItem extends Model
{
    public function bucketlist()
    {
        return $this->belongsTo(Bucketlist::class);
    }
}