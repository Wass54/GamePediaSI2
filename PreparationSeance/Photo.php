<?php

class Photo extends \Illuminate\Database\Eloquent\Model
{
    protected $table='photo';
    protected $primaryKey='id';

    public function annonce(){
        return $this->belongsTo('annonce','annonce_id');
    }
}