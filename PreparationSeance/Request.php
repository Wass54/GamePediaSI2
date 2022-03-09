<?php

use Categorie;
use Annonce;
use Photo;

class Request
{
    /**
     * @var
     */



    function photosFromAnnonce22() {
        $a= Annonce::find(22);
        $p= $a->photo()->get();

        foreach ($p as $val){
            echo($val->id . " " . $val->file . " " . $val->date . "<br>");
        }
    }


    function photoFromAnnonce22WhereOctet(){
        $a= Annonce::find(22);
        $p= $a->photos()->where('taille_octet',">","100000")->get();

        foreach ($p as $val){
            echo($val->id . " " . $val->file . " " . $val->date . "<br>");
        }
    }

    function annonceMore3photos() {
        foreach(Annonce::all() as $value){
            if($value->photos()->count()>3){
                echo($value->id . " " . $value->titre . " " . $value->date . "<br>");
            }
        }
    }

    function annoncePhotosWhereOctet() {
        foreach (Annonce::all() as $value){
            if($value->photos()->where('taille_octet',">","100000")){
                echo($value->id . " " . $value->titre . " " . $value->date . "<br>");
            }
        }
    }

    function ajoutPhoto22(){
        $p = new Photo();
        $p->file='fichier.png';
        $p->date='12/31/2456';
        $p->taille_octet='123455';

        $a = Annonce::find('22');
        $a->photos()->save($p);
    }

    function ajoutAnnonce22toCateg42et73() {
        $p = Annonce::find('22');

        $a = Categorie::find('42');
        $a->categories()->save($p);

        $a = Categorie::find('73');
        $a->categories()->save($p);
    }
}