<?php

namespace game\models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'user';
    protected $primaryKey = 'email';
    public $timestamps = false;

    function commentaires(){
        return $this->hasMany(Comment::class);
    }

}