<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    public $timestamps = false;

    protected $fillable = ['name'];


    public function clients()
    {
        return $this->belongsToMany(Client::class)->withPivot('client_id', 'tag_id');
    }
}
