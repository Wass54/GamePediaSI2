<?php

class Categorie extends \Illuminate\Database\Eloquent\Model
{
    protected $table='categorie';
    protected $primaryKey='id';

    public function annonces(){
        return $this->belongsToMany('Annonce',
                        'categ_Annon',
                            'categ_id',
                            'annonce_id');
    }
}