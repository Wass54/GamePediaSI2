<?php

class Annonce extends \Illuminate\Database\Eloquent\Model
{
    protected $table='annonce';
    protected $primaryKey='id';

    public function categorie(){
        return $this->belongsToMany('Categorie',
                        'categ_Annon',
                            'annonce_id',
                            'categ_id');
    }

    public function photos() {
        return $this->hasMany('Photo','photo_id');
    }
}