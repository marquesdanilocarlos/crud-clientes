<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{

    protected $fillable = ['name', 'email'];

    public function tags()
    {
        return $this->belongsToMany(Tag::class)->withPivot('client_id', 'tag_id');
    }
}
